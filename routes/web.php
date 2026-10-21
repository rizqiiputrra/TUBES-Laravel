<?php

use App\Http\Controllers\PemesananController;

Route::get('/', [PemesananController::class, 'index'])->name('tiket.index');
Route::post('/tiket', [PemesananController::class, 'store'])->name('tiket.store');
Route::put('/tiket/{id}', [PemesananController::class, 'update'])->name('tiket.update');
Route::delete('/tiket/{id}', [PemesananController::class, 'destroy'])->name('tiket.destroy');

Route::get('/pembayaran/{id}', [PemesananController::class, 'pembayaran'])->name('pembayaran.show');
Route::post('/pembayaran/{id}', [PemesananController::class, 'prosesPembayaran'])->name('pembayaran.update');