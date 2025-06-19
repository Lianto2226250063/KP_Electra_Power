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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Invoice::with('pegawai');

        // Filter pencarian
        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor', 'like', '%' . $search . '%')
                ->orWhere('kepada', 'like', '%' . $search . '%')
                ->orWhereHas('pegawai', function ($q2) use ($search) {
                    $q2->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        // Filter berdasarkan bulan
        if ($request->has('bulan') && $request->bulan !== null) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun !== null) {
            $query->whereYear('tanggal', $request->tahun);
        }

        // Ambil data per 10 baris per halaman
        $invoice = $query->latest()->paginate(10)->withQueryString();

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
        // Validasi input dari form
        $validated = $request->validate([
            'nomor' => 'required|string|max:50',
            'kepada' => 'required|string|max:50',
            'tanggal' => 'required|date',
            // 'lokasi' => 'required|string|max:50',
            'keterangan' => 'required|array',
            'jumlah' => 'required|array',
            'harga_satuan' => 'required|array',
        ]);

        $rawNomor = trim($validated['nomor']);
        $tanggal = \Carbon\Carbon::parse($validated['tanggal']);
        $bulan = $tanggal->format('m');
        $tahun = $tanggal->format('y');
        $finalNomor = $rawNomor . '/' . $bulan . '-' . $tahun;

        // Simpan data invoice
        $invoice = new Invoice([
            'nomor' => $finalNomor,
            'kepada' => trim($validated['kepada']),
            'tanggal' => $validated['tanggal'],
            // 'lokasi' => $validated['lokasi'],
            'id_pegawai' => Auth::id(),  // Menyimpan nama pengguna yang sedang login
        ]);
        $invoice->save();

        // Simpan detail invoice
        foreach ($validated['keterangan'] as $index => $keterangan) {
            $barang = Barang::where('nama', trim($keterangan))->first();
            if(!$barang){
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

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('invoice.index')->with('success', 'Invoice berhasil ditambahkan.');
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
        $invoice = Invoice::with('items')->findOrFail($invoice->id);
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
            'tanggal' => 'required|date',
            'keterangan' => 'required|array',
            'jumlah' => 'required|array',
            'harga_satuan' => 'required|array',
            'detailId' => 'array',
        ]);

        // Update invoice utama
        $invoice->update([
            'kepada' => trim($request->kepada),
            'tanggal' => $request->tanggal,
        ]);

        // Ambil semua ID detail lama dari DB
        $existingDetailIds = $invoice->items()->pluck('id')->toArray();
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
        $invoice = Invoice::with('items')->findOrFail($invoice);
        $subtotal = 0;
        foreach ($invoice->items as $item) {
            $subtotal += $item->harga_satuan * $item->jumlah;
        }
        $total = $subtotal + ($subtotal * 0.11);
        $terbilang = $this->terbilang($total);
        return view('invoice.print', compact('invoice', 'terbilang'));
    }
    private function terbilang($angka)
    {
        $angka = abs($angka);
        $baca = [
            '', 'satu', 'dua', 'tiga', 'empat', 'lima',
            'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'
        ];
        $hasil = '';

        if ($angka < 12) {
            $hasil = " " . $baca[$angka];
        } elseif ($angka < 20) {
            $hasil = $this->terbilang($angka - 10) . " belas ";
        } elseif ($angka < 100) {
            $hasil = $this->terbilang($angka / 10) . " puluh " . $this->terbilang($angka % 10);
        } elseif ($angka < 200) {
            $hasil = " seratus" . $this->terbilang($angka - 100);
        } elseif ($angka < 1000) {
            $hasil = $this->terbilang($angka / 100) . " ratus " . $this->terbilang($angka % 100);
        } elseif ($angka < 2000) {
            $hasil = " seribu" . $this->terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            $hasil = $this->terbilang($angka / 1000) . " ribu " . $this->terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            $hasil = $this->terbilang($angka / 1000000) . " juta " . $this->terbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            $hasil = $this->terbilang($angka / 1000000000) . " miliar " . $this->terbilang($angka % 1000000000);
        } else {
            $hasil = $this->terbilang($angka / 1000000000000) . " triliun " . $this->terbilang($angka % 1000000000000);
        }

        return trim($hasil);
    }

    public function download($invoice)
    {
        $invoice = Invoice::with('items')->findOrFail($invoice);

        $subtotal = 0;
        foreach ($invoice->items as $item) {
            $subtotal += $item->harga_satuan * $item->jumlah;
        }
        $total = $subtotal + ($subtotal * 0.11);
        $terbilang = $this->terbilang($total);
        $safeFileName = 'invoice-' . str_replace(['/', '\\'], '-', $invoice->nomor) . '.pdf';

        $pdf = Pdf::loadView('invoice.print', compact('invoice', 'terbilang'));

        return $pdf->download($safeFileName);
    }

}
