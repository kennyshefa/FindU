<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

// 1. Dashboard Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Pencarian
Route::get('/cari', [ItemController::class, 'search'])->name('items.search');

// 3. Detail Barang & Klaim
Route::get('/barang/{id?}', [ItemController::class, 'show'])->name('items.show');
Route::post('/barang/{id}/klaim', [ItemController::class, 'submitClaim'])->name('items.claim.submit');

// 4. Lapor Barang Ditemukan & Berhasil
Route::get('/lapor-ditemukan', [ItemController::class, 'createFound'])->name('items.create-found');
Route::post('/lapor-ditemukan', [ItemController::class, 'storeFound'])->name('items.store-found');
Route::get('/laporan-ditemukan-berhasil', [ItemController::class, 'successFound'])->name('items.success-found');

// 5. Lapor Barang Hilang & Berhasil
Route::get('/lapor-hilang', [ItemController::class, 'createLost'])->name('items.create-lost');
Route::post('/lapor-hilang', [ItemController::class, 'storeLost'])->name('items.store-lost');
Route::get('/laporan-hilang-berhasil', [ItemController::class, 'successLost'])->name('items.success-lost');

// 6. Berhasil Klaim
Route::get('/klaim-berhasil', [ItemController::class, 'claimSuccess'])->name('items.claim-success');

// 7. Riwayat Saya / Klaim
Route::get('/klaim', [ClaimController::class, 'index'])->name('claims.index');
Route::post('/klaim/{id}/batal', [ClaimController::class, 'cancel'])->name('claims.cancel');
Route::post('/klaim/reset', [ClaimController::class, 'resetClaims'])->name('claims.reset');

// 8. Tentang Kami
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

// 9. Profile Pengguna & Edit Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

// 10. Auth: Login & Register
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');