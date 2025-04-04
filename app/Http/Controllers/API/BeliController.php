<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\beli;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BeliController extends Controller
{
    public function index()
    {
        $beli = beli::all();
        if ($beli->isEmpty()) {
            $response['message'] = 'Tidak ada beli yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'beli ditemukan.';
        $response['data'] = $beli;
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'catatan' => 'required',
            'durasi'=> 'required',
            'alamat'=> 'required',
            'jual_id'=> 'required',
        ]);

        $beli = beli::create($validate);
        if($beli){
            $response['success'] = true;
            $response['message'] = 'beli berhasil ditambahkan.';
            return response()->json($response, Response::HTTP_CREATED);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'catatan' => 'required',
            'durasi'=> 'required',
            'alamat'=> 'required',
            'jual_id'=> 'required',
        ]);
        
        beli::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'beli berhasil diperbarui.';
        return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $beli = beli::where('id', $id);
        if(count($beli->get())){
            $beli->delete();
            $response['success'] = true;
            $response['message'] = 'beli berhasil dihapus.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'beli tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        } 
    }
}
