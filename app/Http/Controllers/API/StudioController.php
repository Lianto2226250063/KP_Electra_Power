<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\studio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudioController extends Controller
{
    public function index()
    {
        $studio = studio::all();
        if ($studio->isEmpty()) {
            $response['message'] = 'Tidak ada studio yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'studio ditemukan.';
        $response['data'] = $studio;
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:studios'
        ]);

        $studio = studio::create($validate);
        if($studio){
            $response['success'] = true;
            $response['message'] = 'studio berhasil ditambahkan.';
            return response()->json($response, Response::HTTP_CREATED);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:studios',
        ]);

        studio::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'studio berhasil diperbarui.';
        return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $studio = studio::where('id', $id);
        if(count($studio->get())){
            $studio->delete();
            $response['success'] = true;
            $response['message'] = 'studio berhasil dihapus.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'studio tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        } 
    }
}
