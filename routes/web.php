<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClaimController;

Route::get('/', function () {
    return redirect()->route('claims.index');
});

Route::get('/klaim', [ClaimController::class, 'index'])->name('claims.index');
Route::post('/klaim/{id}/batal', [ClaimController::class, 'cancel'])->name('claims.cancel');
