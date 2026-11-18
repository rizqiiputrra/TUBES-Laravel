<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemesananController;

// belum login
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// pengguna terautentifikasi (bisa admin bisa user)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// RUTE YANG BUTUH LOGIN (auth) + ROLE USER ATAU ADMIN
Route::middleware(['auth', 'role:user,admin'])->group(function () {

    // semua yang login bisa lihat form pesan tiket & daftar pesanan
    Route::get('/', [PemesananController::class, 'index'])->name('tiket.index');

    // User & admin bisa pesan tiket baru
    Route::post('/tiket', [PemesananController::class, 'store'])->name('tiket.store');

    // User & admin bisa bayar
    Route::get('/pembayaran/{id}', [PemesananController::class, 'pembayaran'])->name('pembayaran.show');
    Route::post('/pembayaran/{id}', [PemesananController::class, 'prosesPembayaran'])->name('pembayaran.update');
});

// admin aja
Route::middleware(['auth', 'role:admin'])->group(function () {

    // cuman admin yang bisa edit & hapus pemesanan
    Route::put('/tiket/{id}', [PemesananController::class, 'update'])->name('tiket.update');
    Route::delete('/tiket/{id}', [PemesananController::class, 'destroy'])->name('tiket.destroy');
});
