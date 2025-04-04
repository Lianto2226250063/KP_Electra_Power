<?php

namespace App\Http\Controllers;

use App\Models\jenis;
use App\Models\listfilm;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = jenis::all();
        return view("jenis.index")->with("jenis", $jenis);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('viewAny', jenis::class);
        return view("jenis.create");
    }

    public function store(Request $request)
    {
        $this->authorize('viewAny', jenis::class);
        $validasi = $request->validate([
            "nama"=> "required|unique:jenis"
        ]);
        // Simpan data ke tabel jenis
        jenis::create($validasi);
        // Redirect ke jenis/index
        return redirect()->route('jenis.index')->with("success","Data jenis berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $listfilm = listfilm::where('jenis_id', $id)->get();
        $jenis = jenis::find($id);
        return view("jenis.show")->with("listfilm", $listfilm)->with("jenis", $jenis);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('viewAny', jenis::class);
        $jenis = jenis::find($id);
        return view("jenis.edit")->with("jenis",$jenis);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('viewAny', Genre::class);
        $validasi = $request->validate([
            "nama" => "required|unique:jeniss"
        ]);
        jenis::find($id)->update($validasi);
        return redirect()->route('jenis.index')->with('success','Data jenis berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('viewAny', Genre::class);
        $jenis = jenis::find($id)->delete();
        return redirect()->route('jenis.index')->with('success','Data jenis berhasil dihapus.');
    }
}
