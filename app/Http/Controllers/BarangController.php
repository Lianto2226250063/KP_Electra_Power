<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Tampilkan semua barang
    public function index(Request $request)
    {
        $query = Barang::query();

        // Filter pencarian
        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                ->orWhere('nama', 'like', '%' . $search . '%');
            });
        }

        // Ambil data per 10 baris per halaman
        $barang = $query->latest()->paginate(10)->withQueryString();
        return view('barang.index', compact('barang'));
    }

    // Form tambah barang
    public function create()
    {
        return view('barang.create');
    }

    // Simpan barang baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Barang::create($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }


    // Tampilkan form edit
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    // Update data barang
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
        ]);

        $barang->update($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    // Hapus barang
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
