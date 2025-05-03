<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Invoice; // Pastikan model Invoice yang benar digunakan
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    public function index()
    {
        // Ambil semua data invoice
        $invoices = Invoice::with('details')->get(); // Menyertakan detail invoice

        if ($invoices->isEmpty()) {
            $response['message'] = 'Tidak ada data yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'Data ditemukan.';
        $response['data'] = $invoices;
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validasi request input
        $validated = $request->validate([
            'nomor' => 'required|string|max:50',
            'kepada' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:50',
            'pegawai' => 'nullable|string|max:55', // Optional, bisa diambil dari auth user jika perlu
            'keterangan' => 'required|array',
            'jumlah' => 'required|array',
            'harga_satuan' => 'required|array',
        ]);

        // Menyimpan invoice
        $invoice = new Invoice([
            'nomor' => $validated['nomor'],
            'kepada' => $validated['kepada'],
            'tanggal' => $validated['tanggal'],
            'lokasi' => $validated['lokasi'],
            'pegawai' => $validated['pegawai'] ?? auth()->user()->name, // Menambahkan nama user jika pegawai tidak diberikan
        ]);
        $invoice->save();

        // Menyimpan detail invoice
        foreach ($validated['keterangan'] as $index => $keterangan) {
            $invoice->details()->create([
                'keterangan' => $keterangan,
                'jumlah' => $validated['jumlah'][$index],
                'harga_satuan' => $validated['harga_satuan'][$index],
            ]);
        }

        $response['success'] = true;
        $response['message'] = 'Invoice berhasil ditambahkan.';
        $response['data'] = $invoice;
        return response()->json($response, Response::HTTP_CREATED);
    }

    public function update(Request $request, $invoice)
    {
        // Validasi input
        $validated = $request->validate([
            'nomor' => 'required|string|max:50',
            'kepada' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:50',
            'pegawai' => 'nullable|string|max:55',
            'keterangan' => 'required|array',
            'jumlah' => 'required|array',
            'harga_satuan' => 'required|array',
        ]);

        // Cari invoice yang akan diupdate
        $invoice = Invoice::find($invoice);
        if (!$invoice) {
            $response['success'] = false;
            $response['message'] = 'Invoice tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        // Update data invoice
        $invoice->update([
            'nomor' => $validated['nomor'],
            'kepada' => $validated['kepada'],
            'tanggal' => $validated['tanggal'],
            'lokasi' => $validated['lokasi'],
            'pegawai' => $validated['pegawai'] ?? auth()->user()->name,
        ]);

        // Update detail invoice
        foreach ($validated['keterangan'] as $index => $keterangan) {
            $invoice->details()->updateOrCreate(
                ['id' => $validated['id'][$index] ?? null],
                [
                    'keterangan' => $keterangan,
                    'jumlah' => $validated['jumlah'][$index],
                    'harga_satuan' => $validated['harga_satuan'][$index],
                ]
            );
        }

        $response['success'] = true;
        $response['message'] = 'Invoice berhasil diperbarui.';
        return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($invoice)
    {
        // Cari invoice berdasarkan ID
        $invoice = Invoice::find($invoice);
        if (!$invoice) {
            $response['success'] = false;
            $response['message'] = 'Invoice tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        // Hapus invoice dan detailnya
        $invoice->delete();

        $response['success'] = true;
        $response['message'] = 'Invoice berhasil dihapus.';
        return response()->json($response, Response::HTTP_OK);
    }
    public function print($invoice)
    {
        $invoice = Invoice::with('items')->findOrFail($invoice);
        return view('invoice.print', compact('invoice'));
    }
}
