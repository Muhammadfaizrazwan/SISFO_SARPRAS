<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\PeminjamanApiController;
use App\Http\Controllers\Api\PengembalianAPIController;
use App\Http\Controllers\PengembalianController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('kategori-barang', KategoriBarangController::class);
    Route::apiResource('barang', BarangController::class);
});



Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');




Route::get('/peminjaman/{peminjaman}/return', [PeminjamanController::class, 'returnForm'])->name('peminjaman.returnForm');
Route::post('/peminjaman/{peminjaman}/return', [PeminjamanController::class, 'returnUpdate'])->name('peminjaman.returnUpdate');
Route::post('/peminjaman', [PeminjamanController::class, 'store']);




Route::get('/barang', [BarangApiController::class, 'index']);
Route::get('/barang/{id}', [BarangApiController::class, 'show']);

Route::get('/barangs', function () {
    return \App\Models\Barang::all();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('peminjaman', PeminjamanController::class);
});


Route::apiResource('peminjaman', PeminjamanApiController::class);


Route::post('/peminjaman', [PeminjamanController::class, 'store']);


// api.php
Route::get('/pengembalian', [PengembalianApiController::class, 'index']);
Route::post('/pengembalian/{id}', [PengembalianApiController::class, 'store']);

Route::post('/pengembalian', [PengembalianController::class, 'storeApi']);


Route::get('/pengembalian', [PengembalianAPIController::class, 'index']);
Route::post('/pengembalian/{id}', [PengembalianAPIController::class, 'store']);
Route::post('/pengembalian/tolak', [PengembalianAPIController::class, 'tolak']); // ✅ baru

Route::get('/pengembalian', [PengembalianApiController::class, 'index']);
Route::post('/pengembalian/{id}', [PengembalianApiController::class, 'store']);
Route::post('/pengembalian/tolak', [PengembalianApiController::class, 'tolak']);
