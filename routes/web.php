<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JualController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeliController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/home', [JualController::class, 'index'])->name('home');
Route::get('/{jual}', [JualController::class, 'show'])->name('jual.show');

Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {

    Route::controller(BeliController::class)->prefix('/beli')->name('beli.')->group(function () {
        Route::get('/belimu', 'indexbeli')->name('indexbeli');
        Route::get('/pesanmu', 'indexpesan')->name('indexpesan');
        Route::get('/create/{jual}','create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::patch('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/show/{id}','show')->name('show');
    });
    });
    Route::controller(JualController::class)->prefix('/jual')->name('jual.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/jualmu', 'indexjual')->name('indexjual');
        Route::get('/create','create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{jual}', 'edit')->name('edit');
        Route::patch('/update/{jual}', 'update')->name('update');
        Route::delete('/delete/{jual}', 'destroy')->name('destroy');
    });
    Route::controller(UserController::class)->prefix('/user')->name('user.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::patch('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes...


require __DIR__.'/auth.php';
