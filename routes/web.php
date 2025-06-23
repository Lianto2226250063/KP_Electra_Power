<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
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
Route::get('/invoice/index', [InvoiceController::class, 'index'])->name('home');
Route::get('/invoice/show/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

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
    });
    Route::controller(BarangController::class)->prefix('/barang')->name('barang.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/barangmu', 'indexbarang')->name('indexbarang');
        Route::get('/create','create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{barang}', 'edit')->name('edit');
        Route::patch('/update/{barang}', 'update')->name('update');
        Route::delete('/delete/{barang}', 'destroy')->name('destroy');
    });
    Route::controller(UserController::class)->prefix('/user')->name('user.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/toggle-status/{user}', 'toggleStatus')->name('toggleStatus');
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
