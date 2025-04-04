<?php

namespace App\Http\Controllers;

use App\Models\genre;
use App\Models\listfilm;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $genre = genre::all();
        return view("genre.index")->with("genre", $genre);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Genre::class);

        return view("genre.create");
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            "nama"=> "required|unique:genres"
        ]);
        // Simpan data ke tabel genre
        Genre::create($validasi);
        // Redirect ke genre/index
        return redirect()->route('genre.index')->with("success","Data genre berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd($id);
        $listfilm = listfilm::where('genre_id', $id)->get();
        $genre = genre::find($id);
        return view("genre.show")->with("listfilm", $listfilm)->with("genre", $genre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('viewAny', Genre::class);
        $genre = Genre::find($id);
        return view("genre.edit")->with("genre",$genre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('viewAny', Genre::class);
        $validasi = $request->validate([
            "nama" => "required|unique:genres"
        ]);
        Genre::find($id)->update($validasi);
        return redirect()->route('genre.index')->with('success','Data genre berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $genre = Genre::find($id)->delete();
        return redirect()->route('genre.index')->with('success','Data genre berhasil dihapus.');
    }
}
