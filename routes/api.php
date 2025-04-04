<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\JenisController;
use App\Http\Controllers\API\ListfilmController;
use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\StudioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('genre',[GenreController::class, 'index']);
Route::post('genre', [GenreController::class, 'store']);
Route::post('genre/{id}', [GenreController::class, 'update']);
Route::delete('genre/{id}', [GenreController::class, 'destroy']);

Route::get('jenis',[JenisController::class, 'index']);
Route::post('jenis', [JenisController::class, 'store']);
Route::post('jenis/{id}', [JenisController::class, 'update']);
Route::delete('jenis/{id}', [JenisController::class, 'destroy']);

Route::get('rating',[RatingController::class, 'index']);
Route::post('rating', [RatingController::class, 'store']);
Route::post('rating/{id}', [RatingController::class, 'update']);
Route::delete('rating/{id}', [RatingController::class, 'destroy']);

Route::get('studio',[StudioController::class, 'index']);
Route::post('studio', [StudioController::class, 'store']);
Route::post('studio/{id}', [StudioController::class, 'update']);
Route::delete('studio/{id}', [StudioController::class, 'destroy']);

Route::get('listfilm',[ListfilmController::class, 'index']);
Route::post('listfilm', [ListfilmController::class, 'store']);
Route::post('listfilm/{id}', [ListfilmController::class, 'update']);
Route::delete('listfilm/{id}', [ListfilmController::class, 'destroy']);

