<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JualController;
use App\Http\Controllers\API\BeliController;
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

Route::get('beli',[BeliController::class, 'index']);
Route::post('beli', [BeliController::class, 'store']);
Route::post('beli/{id}', [BeliController::class, 'update']);
Route::delete('beli/{id}', [BeliController::class, 'destroy']);

Route::get('jual',[JualController::class, 'index']);
Route::post('jual', [JualController::class, 'store']);
Route::post('jual/{id}', [JualController::class, 'update']);
Route::delete('jual/{id}', [JualController::class, 'destroy']);

