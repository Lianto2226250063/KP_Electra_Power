<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordOTPController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::middleware('guest')->group(function () {
    // Halaman welcome
    Route::get('/', fn() => view('welcome'))->name('welcome');

    // Login
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

    // === Forgot Password pakai OTP ===
    Route::get('/forgot-password', [ForgotPasswordOTPController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordOTPController::class, 'sendOTP'])->name('password.email');

    Route::get('/verify-otp', [ForgotPasswordOTPController::class, 'showVerifyOTPForm'])->name('password.verify.form');
    Route::post('/verify-otp', [ForgotPasswordOTPController::class, 'verifyOTP'])->name('password.verify');

    Route::get('/reset-password-form', [ForgotPasswordOTPController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/reset-password', [ForgotPasswordOTPController::class, 'resetPassword'])->name('password.update.custom');

    // Test kirim email
    Route::get('/test-email', function () {
        Mail::raw('Test Gmail SMTP sukses!', function ($m) {
            $m->to('lianto1566@gmail.com')->subject('Test Email dari Laravel');
        });
        return '✅ Email sudah dikirim!';
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Invoice
    Route::controller(InvoiceController::class)->prefix('/invoice')->name('invoice.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/invoicemu', 'indexinvoice')->name('indexinvoice');
        Route::get('/create', 'create')->name('create');
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
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{barang}', 'edit')->name('edit');
        Route::patch('/update/{barang}', 'update')->name('update');
        Route::delete('/delete/{barang}', 'destroy')->name('destroy');
    });

    // User Management
    Route::controller(UserController::class)->prefix('/user')->name('user.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/toggle-status/{user}', 'toggleStatus')->name('toggleStatus');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/password', 'edit')->name('password.edit');
        Route::post('/password', 'updatePassword')->name('password.update');
    });
});

require __DIR__ . '/auth.php';
