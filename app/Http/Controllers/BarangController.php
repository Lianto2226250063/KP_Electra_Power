<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Tampilkan daftar barang dengan filter dan pagination.
     */
    public function index(Request $request)
    {
        $query = Barang::query();

        // Filter berdasarkan keyword pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                  ->orWhere('nama', 'like', '%' . $search . '%');
            });
        }

        // Ambil data barang, 10 per halaman
        $barang = $query->orderBy('id', 'asc')->paginate(10)->withQueryString(); // ASC

        return view('barang.index', compact('barang'));
    }

    /**
     * Tampilkan form tambah barang.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Simpan barang baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Barang::create($validated);

        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit barang.
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    /**
     * Proses update barang.
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $barang->update($validated);

        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil diupdate.');
    }

    /**
     * Hapus barang.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil dihapus.');
    }
}
