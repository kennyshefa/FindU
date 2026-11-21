<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;

// Halaman Default (Redirect ke Riwayat / Klaim)
Route::get('/', function () {
    return redirect()->route('claims.index');
})->name('home');

// Halaman Klaim Saya (Riwayat)
Route::get('/klaim', [ClaimController::class, 'index'])->name('claims.index');
Route::post('/klaim/{id}/batal', [ClaimController::class, 'cancel'])->name('claims.cancel');

// Halaman Tentang Kami
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

// Halaman Profile Pengguna
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
