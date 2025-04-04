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
    public function index()
    {
        $beli = beli::all();
        return view("beli.index")->with("beli", $beli);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jual = jual::all();
        return view('beli.create')->with('jual', $jual);
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
        return redirect()->route('beli.index')->with("success","Data beli berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jual = jual::where('beli_id', $id)->get();
        $beli = beli::find($id);
        return view("beli.show")->with("jual", $jual)->with("beli", $beli);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $beli = beli::find($id);
        return view("beli.edit")->with("beli",$beli);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            "catatan" => "required",
            "durasi" => "required",
            "alamat" => "required",
            "jumlah"=> "required",
            "jual_id"=> "required",
        ]);
        $validasi['nama'] = Auth::user()->name;
        beli::find($id)->update($validasi);
        return redirect()->route('beli.index')->with('success','Data beli berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $beli = beli::find($id)->delete();
        return redirect()->route('beli.index')->with('success','Data beli berhasil dihapus.');
    }
}
