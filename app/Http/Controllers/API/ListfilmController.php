<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\listfilm;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ListfilmController extends Controller
{
    public function index(){
        $listfilm = listfilm::all();
        if ($listfilm->isEmpty()) {
            $response['message'] = 'Tidak ada film yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'film ditemukan.';
        $response['data'] = $listfilm;
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
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

        $listfilm = listfilm::create($validate);
        if($listfilm){
            $response['success'] = true;
            $response['message'] = 'film berhasil ditambahkan.';
            return response()->json($response, Response::HTTP_CREATED);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
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

        listfilm::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'film berhasil diperbarui.';
        return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $listfilm = listfilm::where('id', $id);
        if(count($listfilm->get())){
            $listfilm->delete();
            $response['success'] = true;
            $response['message'] = 'film berhasil dihapus.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'film tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        } 
    }
}
