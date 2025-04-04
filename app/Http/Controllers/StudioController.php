<?php

namespace App\Http\Controllers;

use App\Models\listfilm;
use App\Models\studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studio = studio::all();
        return view("studio.index")->with("studio", $studio);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('viewAny', studio::class);
        return view("studio.create");
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            "nama"=> "required|unique:studios"
        ]);
        // Simpan data ke tabel studio
        studio::create($validasi);
        // Redirect ke studio/index
        return redirect()->route('studio.index')->with("success","Data studio berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $listfilm = listfilm::where('studio_id', $id)->get();
        $studio = studio::find($id);
        return view("studio.show")->with("listfilm", $listfilm)->with("studio", $studio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('viewAny', studio::class);
        $studio = studio::find($id);
        return view("studio.edit")->with("studio",$studio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            "nama" => "required|unique:studios"
        ]);
        studio::find($id)->update($validasi);
        return redirect()->route('studio.index')->with('success','Data studio berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('viewAny', studio::class);
        $studio = Studio::find($id)->delete();
        return redirect()->route('studio.index')->with('success','Data studio berhasil dihapus.');
    }
}
