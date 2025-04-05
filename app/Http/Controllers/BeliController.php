<?php

namespace App\Http\Controllers;

use App\Models\beli;
use App\Models\jual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexbeli()
    {
        $beli = beli::all();
        return view("beli.indexbeli")->with("beli", $beli);
    }
    public function indexpesan()
    {
        $beli = beli::all();
        return view("beli.indexpesan")->with("beli", $beli);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($jual)
    {
        $jual = jual::findOrFail($jual); // Ambil satu data berdasarkan id
        return view('beli.create', compact('jual'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            "catatan" => "required",
            "durasi" => "required",
            "alamat" => "required",
            "jumlah"=> "required",
            "jual_id"=> "required",
        ]);
        $validasi['nama'] = Auth::user()->name;

        // Simpan data ke tabel beli
        beli::create($validasi);
        // Redirect ke beli/index
        return redirect()->route('beli.indexbeli')->with("success","Data beli berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $beli = Beli::with('jual')->findOrFail($id);

        // Cek apakah nama pembeli sama dengan user yang login
        if ($beli->nama !== Auth::user()->name) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return view("beli.show", [
            "beli" => $beli,
            "jual" => $beli->jual
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     $beli = beli::find($id);
    //     return view("beli.edit")->with("beli",$beli);
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, beli $beli)
    // {
    //     $validasi = $request->validate([
    //         "catatan" => "required",
    //         "durasi" => "required",
    //         "alamat" => "required",
    //         "jumlah"=> "required",
    //         "jual_id"=> "required",
    //         "nama"=> "required",
    //     ]);
    //     $beli->update($validasi);
    //     return redirect()->route('beli.index')->with('success','Data beli berhasil diubah');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $beli = beli::find($id)->delete();
        return redirect()->route('home')->with('success','Data beli berhasil dihapus.');
    }
}
