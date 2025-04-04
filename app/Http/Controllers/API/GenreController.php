<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\genre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GenreController extends Controller
{
    public function index()
    {
        $genre = genre::all();
        if ($genre->isEmpty()) {
            $response['message'] = 'Tidak ada genre yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'genre ditemukan.';
        $response['data'] = $genre;
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:genres'
        ]);

        $genre = genre::create($validate);
        if($genre){
            $response['success'] = true;
            $response['message'] = 'genre berhasil ditambahkan.';
            return response()->json($response, Response::HTTP_CREATED);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:genres',
        ]);
        genre::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'genre berhasil diperbarui.';
        return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $genre = genre::where('id', $id);
        if(count($genre->get())){
            $genre->delete();
            $response['success'] = true;
            $response['message'] = 'genre berhasil dihapus.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'genre tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        } 
    }
}
