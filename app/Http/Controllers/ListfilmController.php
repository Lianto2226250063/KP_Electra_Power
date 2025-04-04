<?php

namespace App\Http\Controllers;

use App\Models\genre;
use App\Models\listfilm;
use App\Models\jenis;
use App\Models\rating;
use App\Models\studio;
use Illuminate\Http\Request;

class ListfilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $listfilm = listfilm::where('nama', 'like','%'.$request->search.'%')->get();
        } else {
            $listfilm = listfilm::all();
        }
        return view("home")->with("listfilm", $listfilm);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('viewAny', listfilm::class);
        $genre = genre::all();
        $jenis = jenis::all();
        $rating = rating::all();
        $studio = studio::all();
        return view('listfilm.create')->with('genre', $genre)->with('jenis',$jenis)
        ->with('rating', $rating)->with('studio', $studio);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->authorize('viewAny', listfilm::class);
        $validasi = $request->validate([
            'foto' => 'image',
            'nama' => 'required',
            'deskripsi' => 'required',
            'produser' => 'required',
            'skor' => 'required',
            'genre_id' => 'required',
            'studio_id' => 'required',
            'rating_id' => 'required',
            'jenis_id' => 'required'
        ]);
        if ($request->foto) {
            $ext = $request->foto->getClientOriginalExtension();
            $validasi["foto"] = $request->nama.".".$ext;
            $request->foto->move(public_path('images'), $validasi["foto"]);
        }
        listfilm::create($validasi);
        return redirect("home")->with("success","Data Film berhasil disimpan");


    }

    /**
     * Display the specified resource.
     */
    public function show(listfilm $listfilm)
    {
        return view('detail')->with('listfilm', $listfilm);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(listfilm $listfilm)
    {
        // $this->authorize('update', $listfilm);
        // dd($listfilm);
        $this->authorize('viewAny', listfilm::class);
        $data['genre'] = genre::all();
        $data['jenis'] = jenis::all();
        $data['rating'] = rating::all();
        $data['studio'] = studio::all();
        $data['listfilm'] = $listfilm;
        return view("listfilm.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, listfilm $listfilm)
    {
        // dd($request);
        $this->authorize('viewAny', listfilm::class);
        $validasi = $request->validate([
            'foto' => 'image',
            'nama' => 'required',
            'deskripsi' => 'required',
            'produser' => 'required',
            'skor' => 'required',
            'genre_id' => 'required',
            'studio_id' => 'required',
            'rating_id' => 'required',
            'jenis_id' => 'required'
        ]);
        if ($request->foto) {
            $ext = $request->foto->getClientOriginalExtension();
            $validasi["foto"] = $request->nama.".".$ext;
            $request->foto->move(public_path('images'), $validasi["foto"]);
            $listfilm->foto = $validasi["foto"];
        }
        $listfilm->nama = $request->nama;
        $listfilm->deskripsi = $request->deskripsi;
        $listfilm->produser = $request->produser;
        $listfilm->skor = $request->skor;
        $listfilm->genre_id = $request->genre_id;
        $listfilm->studio_id = $request->studio_id;
        $listfilm->rating_id = $request->rating_id;
        $listfilm->jenis_id = $request->jenis_id;
        $listfilm->save();
        return redirect("home")->with("success","Data Film berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(listfilm $listfilm)
    {
        $this->authorize('viewAny', listfilm::class);
        $listfilm->delete();
        return redirect()->route('home')->with('success','Data film berhasil dihapus.');
    }
    public function detail(listfilm $listfilm)
        {
            return view('detail');
        }

}
