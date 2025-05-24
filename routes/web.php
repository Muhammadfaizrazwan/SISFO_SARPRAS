<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route di sini hanya untuk tampilan web (bukan API)
|--------------------------------------------------------------------------
*/

// ==========================
// Auth Routes (Web)
// ==========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/login/action', [AuthController::class, 'login'])->name('actionlogin');
Route::post('/register/action', [AuthController::class, 'register'])->name('actionregister');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ==========================
// Dashboard & Profil
// ==========================
Route::get('/dashboard', [BarangController::class, 'total'])->middleware('auth')->name('dashboard');
Route::get('/me', fn () => Auth::user())->middleware('auth')->name('me');

// ==========================
// Resource Routes (CRUD)
// ==========================
Route::middleware('auth')->group(function () {
    Route::resources([
        'kategori' => KategoriBarangController::class,
        'barang' => BarangController::class,
        'peminjaman' => PeminjamanController::class,
        'pengembalian' => PengembalianController::class,
        'pengguna' => PenggunaController::class,
    ]);
});

// ==========================
// Peminjaman Actions
// ==========================
Route::patch('/peminjaman/{id}/setuju', [PeminjamanController::class, 'setuju'])->name('peminjaman.setuju');
Route::patch('/peminjaman/{id}/tolak', [PeminjamanController::class, 'tolak'])->name('peminjaman.tolak');

// ==========================
// Pengembalian Manual Routes
// ==========================
Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::get('/pengembalian/{id}/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::post('/pengembalian/{id}', [PengembalianController::class, 'store'])->name('pengembalian.store');

// ==========================
// Laporan Peminjaman Routes
// ==========================
Route::prefix('laporan')->middleware('auth')->group(function () {
    Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/export-pdf', [LaporanController::class, 'exportPDF'])->name('laporan.exportPDF');
    Route::get('/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.exportExcel');

    // Laporan Barang
    Route::get('/barang', [LaporanController::class, 'laporanBarang'])->name('laporan.barang');
    Route::get('/barang/export-pdf', [BarangController::class, 'exportPDF'])->name('laporanBarang.exportPDF');
    Route::get('/barang/export-excel', [BarangController::class, 'exportExcel'])->name('laporanBarang.exportExcel');
});


// ==========================
// Welcome Page
// ==========================
Route::get('/', function () {
    return view('welcome');
});
