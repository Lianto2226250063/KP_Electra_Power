<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\jenis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = jenis::all();
        if ($jenis->isEmpty()) {
            $response['message'] = 'Tidak ada jenis yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'jenis ditemukan.';
        $response['data'] = $jenis;
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:jenis'
        ]);

        $jenis = jenis::create($validate);
        if($jenis){
            $response['success'] = true;
            $response['message'] = 'jenis berhasil ditambahkan.';
            return response()->json($response, Response::HTTP_CREATED);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:jenis',
        ]);

        jenis::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'jenis berhasil diperbarui.';
        return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $jenis = jenis::where('id', $id);
        if(count($jenis->get())){
            $jenis->delete();
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
