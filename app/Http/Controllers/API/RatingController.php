<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\rating;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RatingController extends Controller
{
    public function index()
    {
        $rating = rating::all();
        if ($rating->isEmpty()) {
            $response['message'] = 'Tidak ada rating yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'rating ditemukan.';
        $response['data'] = $rating;
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'rating' => 'required|unique:ratings'
        ]);

        $rating = rating::create($validate);
        if($rating){
            $response['success'] = true;
            $response['message'] = 'rating berhasil ditambahkan.';
            return response()->json($response, Response::HTTP_CREATED);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'rating' => 'required|unique:ratings',
        ]);

        rating::where('id', $id)->update($validate);
        $response['success'] = true;
        $response['message'] = 'rating berhasil diperbarui.';
        return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        
        $rating = rating::where('id', $id);
        if(count($rating->get())){
            $rating->delete();
            $response['success'] = true;
            $response['message'] = 'rating berhasil dihapus.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'rating tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        } 
    }
}
