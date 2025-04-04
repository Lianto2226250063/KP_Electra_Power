<?php

namespace App\Http\Controllers;

use App\Models\listfilm;
use App\Models\rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rating = rating::all();
        return view("rating.index")->with("rating", $rating);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('viewAny', rating::class);
        return view("rating.create");
    }

    public function store(Request $request)
    {
        $this->authorize('viewAny', rating::class);
        $validasi = $request->validate([
            "rating"=> "required|unique:ratings"
        ]);
        // Simpan data ke tabel rating
        rating::create($validasi);
        // Redirect ke rating/index
        return redirect()->route('rating.index')->with("success","Data rating berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $listfilm = listfilm::where('rating_id', $id)->get();
        $rating = rating::find($id);
        return view("rating.show")->with("listfilm", $listfilm)->with("rating", $rating);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('viewAny', rating::class);
        $rating = rating::find($id);
        return view("rating.edit")->with("rating",$rating);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('viewAny', rating::class);
        $validasi = $request->validate([
            "nama" => "required|unique:ratings"
        ]);
        rating::find($id)->update($validasi);
        return redirect()->route('rating.index')->with('success','Data rating berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rating = rating::find($id)->delete();
        return redirect()->route('rating.index')->with('success','Data rating berhasil dihapus.');
    }
}