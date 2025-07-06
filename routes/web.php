<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KeuanganController;

Route::get('/', [KeuanganController::class, 'dashboard'])->name('dashboard');

Route::get('/pemasukan/create', [KeuanganController::class, 'createPemasukan']);
Route::post('/pemasukan', [KeuanganController::class, 'storePemasukan']);

Route::get('/pengeluaran/create', [KeuanganController::class, 'createPengeluaran']);
Route::post('/pengeluaran', [KeuanganController::class, 'storePengeluaran']);

Route::get('/riwayat', [KeuanganController::class, 'riwayat'])->name('riwayat');

