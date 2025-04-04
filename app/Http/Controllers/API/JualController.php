<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\jual;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JualController extends Controller
{
    public function index(){
        $jual = jual::all();
        if ($jual->isEmpty()) {
            $response['message'] = 'Tidak ada data yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'data ditemukan.';
        $response['data'] = $jual;
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'foto' => 'image',
            'nama' => 'required',
            'deskripsi' => 'required',
            'penjual' => 'required',
            'harga' => 'required',
            'toko' => 'required',
        ]);

        $jual = jual::create($validate);
        if($jual){
            $response['success'] = true;
            $response['message'] = 'data berhasil ditambahkan.';
            return response()->json($response, Response::HTTP_CREATED);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'foto' => 'image',
            'nama' => 'required',
            'deskripsi' => 'required',
            'penjual' => 'required',
            'harga' => 'required',
            'toko' => 'required',
        ]);

        jual::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'data berhasil diperbarui.';
        return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $jual = jual::where('id', $id);
        if(count($jual->get())){
            $jual->delete();
            $response['success'] = true;
            $response['message'] = 'data berhasil dihapus.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'data tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        } 
    }
}
