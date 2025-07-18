<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route yang boleh diakses berdasarkan status login:
| - Guest: hanya welcome, login, register
| - Authenticated user: semua route lain
|
*/

// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
});

// Route yang hanya boleh diakses oleh user yang sudah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Invoice
    Route::controller(InvoiceController::class)->prefix('/invoice')->name('invoice.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/invoicemu', 'indexinvoice')->name('indexinvoice');
        Route::get('/create','create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{invoice}', 'edit')->name('edit');
        Route::patch('/update/{invoice}', 'update')->name('update');
        Route::delete('/delete/{invoice}', 'destroy')->name('destroy');
        Route::get('/{invoice}/print', 'print')->name('print');
        Route::get('/download/{id}', 'download')->name('download');
        Route::put('/toggle-status/{invoice}', 'toggleStatus')->name('toggleStatus');
        Route::get('/show/{invoice}', 'show')->name('show');
    });

    // Barang
    Route::controller(BarangController::class)->prefix('/barang')->name('barang.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/barangmu', 'indexbarang')->name('indexbarang');
        Route::get('/create','create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{barang}', 'edit')->name('edit');
        Route::patch('/update/{barang}', 'update')->name('update');
        Route::delete('/delete/{barang}', 'destroy')->name('destroy');
    });

    // User
    Route::controller(UserController::class)->prefix('/user')->name('user.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/toggle-status/{user}', 'toggleStatus')->name('toggleStatus');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/password', [UserController::class, 'editPassword'])->name('user.editPassword');
        Route::post('/password', [UserController::class, 'updatePassword'])->name('user.updatePassword');

    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route tambahan dari Laravel Breeze atau Jetstream
require __DIR__.'/auth.php';
