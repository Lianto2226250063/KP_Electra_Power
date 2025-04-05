<?php

namespace App\Http\Controllers;

use App\Models\jual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $jual = jual::where('nama', 'like','%'.$request->search.'%')->get();
        } else {
            $jual = jual::all();
        }
        return view("home")->with("jual", $jual);
    }
    public function indexjual()
    {
        $jual = jual::all();
        return view("jual.indexjual")->with("jual", $jual);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jual.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validasi = $request->validate([
            'foto' => 'image',
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'toko' => 'required',
        ]);
        $validasi['penjual'] = Auth::user()->name;

        if ($request->foto) {
            $ext = $request->foto->getClientOriginalExtension();
            $validasi["foto"] = $request->nama.".".$ext;
            $request->foto->move(public_path('images'), $validasi["foto"]);
        }
        jual::create($validasi);
        return redirect("home")->with("success","Data jual berhasil disimpan");


    }

    /**
     * Display the specified resource.
     */
    public function show(jual $jual)
    {
        return view('detail')->with('jual', $jual);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jual $jual)
    {
        // $this->authorize('update', $jual);
        // dd($jual);
        $data['jual'] = $jual;
        return view("jual.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jual $jual)
    {
        // dd($request);
        $validasi = $request->validate([
            'foto' => 'image',
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'toko' => 'required',
        ]);
        $validasi['penjual'] = Auth::user()->name;

        if ($request->foto) {
            $ext = $request->foto->getClientOriginalExtension();
            $validasi["foto"] = $request->nama.".".$ext;
            $request->foto->move(public_path('images'), $validasi["foto"]);
            $jual->foto = $validasi["foto"];
        }
        $jual->nama = $request->nama;
        $jual->deskripsi = $request->deskripsi;
        $jual->harga = $request->harga;
        $jual->toko = $request->toko;
        $jual->save();
        return redirect("home")->with("success","Data jual berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jual $jual)
    {
        $this->authorize('viewAny', jual::class);
        $jual->delete();
        return redirect()->route('home')->with('success','Data jual berhasil dihapus.');
    }
    public function detail(jual $jual)
        {
            return view('detail');
        }

}
