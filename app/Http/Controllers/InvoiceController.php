<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with(['pegawai', 'details']);

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor', 'like', '%' . $search . '%')
                ->orWhere('kepada', 'like', '%' . $search . '%')
                ->orWhereHas('pegawai', function ($q2) use ($search) {
                    $q2->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('prefix')) {
            $prefix = $request->prefix;
            $query->where('nomor', 'like', '%/' . $prefix . '/%');
        }

        $invoice = $query->orderBy('nomor', 'asc')->paginate(10)->withQueryString();

        return view('invoice.index', compact('invoice'));
    }

    public function indexinvoice()
    {
        $invoice = Invoice::all();
        return view("invoice.index")->with("invoice", $invoice);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = \App\Models\Barang::all();
        return view('invoice.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Hilangkan semua spasi dari nomor
        $nomorBersih = preg_replace('/\s+/', '', $request->nomor);
        $nomorLengkap = $nomorBersih . $request->kode_suffix;

        // Validasi input
        $validated = $request->validate([
            'nomor' => 'required|string|max:50',
            'kode_suffix' => 'required|string|max:50',
            'kepada' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'keterangan' => 'required|array',
            'jumlah' => 'required|array',
            'harga_satuan' => 'required|array',
        ]);

        // Ambil bagian sebelum "/" untuk dicek duplikat (misalnya INV001 dari INV001/EP/INV/06-25)
        $nomorPrefix = explode('/INV', $nomorLengkap)[0];

        // Cek apakah ada invoice lain yang nomor-nya dimulai dengan prefix tersebut
        $duplikat = Invoice::where('nomor', 'like', $nomorPrefix . '/%')->exists();
        if ($duplikat) {
            return back()
                ->withErrors(['nomor' => 'Nomor sudah digunakan.'])
                ->withInput();
        }

        // Simpan invoice
        $invoice = new Invoice([
            'nomor' => $nomorLengkap,
            'kepada' => trim($validated['kepada']),
            'tanggal' => $validated['tanggal'],
            'id_pegawai' => Auth::id(),
        ]);
        $invoice->save();

        // Simpan detail invoice
        foreach ($validated['keterangan'] as $index => $keterangan) {
            $barang = Barang::where('nama', trim($keterangan))->first();
            if (!$barang) {
                Barang::create([
                    'nama' => trim($keterangan),
                    'harga' => $validated['harga_satuan'][$index],
                ]);
            }

            InvoiceDetail::create([
                'id_invoice' => $invoice->id,
                'keterangan' => trim($keterangan),
                'jumlah' => $validated['jumlah'][$index],
                'harga_satuan' => $validated['harga_satuan'][$index],
            ]);
        }

        return redirect()->route('invoice.index')->with('success', 'Invoice berhasil ditambahkan.');
    }

    public function toggleStatus(Invoice $invoice)
    {
        $invoice->status = $invoice->status === 'Belum bayar' ? 'Sudah bayar' : 'Belum bayar';
        $invoice->save();

        return redirect()->route('invoice.index')->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        // Menampilkan detail invoice
        return view('invoice.show')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $invoice = Invoice::with('details')->findOrFail($invoice->id);
        $barangs = \App\Models\Barang::all();
        return view('invoice.edit', compact('invoice', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        // Validasi input
        $validated = $request->validate([
            'kepada' => 'required|string|max:50',
            'keterangan' => 'required|array',
            'jumlah' => 'required|array',
            'harga_satuan' => 'required|array',
            'detailId' => 'array',
        ]);

        // Update invoice utama
        $invoice->update([
            'kepada' => trim($request->kepada),
            // 'tanggal' => $request->tanggal,
        ]);

        // Ambil semua ID detail lama dari DB
        $existingDetailIds = $invoice->details()->pluck('id')->toArray();
        $formDetailIds = $request->detailId ?? [];

        // Siapkan array untuk tracking ID yang masih dipakai
        $processedIds = [];

        // Simpan/Update setiap detail yang dikirim dari form
        for ($i = 0; $i < count($request->keterangan); $i++) {
            $detailId = $formDetailIds[$i] ?? null;
            $keterangan = trim($validated['keterangan'][$i]);
            $jumlah = $validated['jumlah'][$i];
            $harga = $validated['harga_satuan'][$i];

            // Tambahkan barang jika belum ada
            $barang = Barang::firstOrCreate(
                ['nama' => $keterangan],
                ['harga' => $harga]
            );

            if ($detailId) {
                // Update detail yang ada
                $detail = InvoiceDetail::find($detailId);
                if ($detail) {
                    $detail->update([
                        'keterangan' => $keterangan,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $harga,
                    ]);
                    $processedIds[] = $detailId;
                }
            } else {
                // Tambah detail baru
                $newDetail = InvoiceDetail::create([
                    'id_invoice' => $invoice->id,
                    'keterangan' => $keterangan,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $harga,
                ]);
                $processedIds[] = $newDetail->id;
            }
        }

        // Hapus detail yang tidak ada dalam form (dihapus user)
        $toDelete = array_diff($existingDetailIds, $processedIds);
        InvoiceDetail::destroy($toDelete);

        return redirect()->route('invoice.index')->with('success', 'Invoice berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        // Otorisasi sebelum menghapus
        // $this->authorize('viewAny', Invoice::class);

        // Menghapus invoice beserta detailnya
        $invoice->delete();

        // Redirect dengan pesan sukses setelah dihapus
        return redirect()->route('invoice.index')->with('success', 'Data invoice berhasil dihapus.');
    }

    /**
     * Menampilkan detail invoice
     */
    public function detail(Invoice $invoice)
    {
        return view('invoice.detail')->with('invoice', $invoice);
    }
    public function print($invoice)
    {
        $invoice = Invoice::with('details', 'pegawai')->findOrFail($invoice);

        $subtotal = 0;
        foreach ($invoice->details as $item) {
            $subtotal += $item->harga_satuan * $item->jumlah;
        }

        // Cek apakah ada PPN berdasarkan nomor invoice
        $hasPPN = str_contains(strtoupper($invoice->nomor), 'EPI');

        if ($hasPPN) {
            $ppn = $subtotal * 0.11;
            $total = $subtotal + $ppn;
        } else {
            $ppn = 0;
            $total = $subtotal;
        }

        $terbilang = $this->terbilang($total);

        return view('invoice.print', compact('invoice', 'terbilang'));
    }
    private function terbilang($angka)
    {
        $angka = abs((int)$angka); // Pastikan angka bulat dan positif
        $baca = [
            '', 'satu', 'dua', 'tiga', 'empat', 'lima',
            'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'
        ];

        if ($angka < 12) {
            return $baca[$angka];
        } elseif ($angka < 20) {
            return $this->terbilang($angka - 10) . ' belas';
        } elseif ($angka < 100) {
            return $this->terbilang(intval($angka / 10)) . ' puluh' . ($angka % 10 !== 0 ? ' ' . $this->terbilang($angka % 10) : '');
        } elseif ($angka < 200) {
            return 'seratus' . ($angka - 100 !== 0 ? ' ' . $this->terbilang($angka - 100) : '');
        } elseif ($angka < 1000) {
            return $this->terbilang(intval($angka / 100)) . ' ratus' . ($angka % 100 !== 0 ? ' ' . $this->terbilang($angka % 100) : '');
        } elseif ($angka < 2000) {
            return 'seribu' . ($angka - 1000 !== 0 ? ' ' . $this->terbilang($angka - 1000) : '');
        } elseif ($angka < 1000000) {
            return $this->terbilang(intval($angka / 1000)) . ' ribu' . ($angka % 1000 !== 0 ? ' ' . $this->terbilang($angka % 1000) : '');
        } elseif ($angka < 1000000000) {
            return $this->terbilang(intval($angka / 1000000)) . ' juta' . ($angka % 1000000 !== 0 ? ' ' . $this->terbilang($angka % 1000000) : '');
        } elseif ($angka < 1000000000000) {
            return $this->terbilang(intval($angka / 1000000000)) . ' miliar' . ($angka % 1000000000 !== 0 ? ' ' . $this->terbilang($angka % 1000000000) : '');
        } else {
            return $this->terbilang(intval($angka / 1000000000000)) . ' triliun' . ($angka % 1000000000000 !== 0 ? ' ' . $this->terbilang($angka % 1000000000000) : '');
        }
    }

    public function download($invoice)
    {
        $invoice = Invoice::with('details')->findOrFail($invoice);

        $subtotal = 0;
        foreach ($invoice->details as $item) {
            $subtotal += $item->harga_satuan * $item->jumlah;
        }
        $total = $subtotal + ($subtotal * 0.11);
        $terbilang = $this->terbilang($total);
        $safeFileName = 'invoice-' . str_replace(['/', '\\'], '-', $invoice->nomor) . '.pdf';

        $pdf = Pdf::loadView('invoice.print', compact('invoice', 'terbilang'));

        return $pdf->download($safeFileName);
    }

}
