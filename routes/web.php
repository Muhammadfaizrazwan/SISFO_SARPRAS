<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
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
// Auth Routes
// ==========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/login/action', [AuthController::class, 'login'])->name('actionlogin');
Route::post('/register/action', [AuthController::class, 'register'])->name('actionregister');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ==========================
// Welcome Page
// ==========================
Route::get('/', fn() => view('welcome'));

// ==========================
// Middleware-protected Routes
// ==========================
Route::middleware('auth')->group(function () {

    // Dashboard & Profil
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/me', fn() => Auth::user())->name('me');

    // CRUD Resource Controllers
    Route::resources([
        'kategori' => KategoriBarangController::class,
        'barang' => BarangController::class,
        'peminjaman' => PeminjamanController::class,
        'pengembalian' => PengembalianController::class,
        'pengguna' => PenggunaController::class,
    ]);

    // Peminjaman Actionsx
    Route::patch('/peminjaman/{id}/setuju', [PeminjamanController::class, 'setuju'])->name('peminjaman.setuju');
    Route::patch('/peminjaman/{id}/tolak', [PeminjamanController::class, 'tolak'])->name('peminjaman.tolak');

    // Pengembalian Manual Actions
    Route::prefix('pengembalian')->group(function () {
        Route::get('{id}/setuju', [PengembalianController::class, 'setuju'])->name('pengembalian.setuju');
        Route::get('{id}/tolak', [PengembalianController::class, 'tolak'])->name('pengembalian.tolak');
        Route::get('{id}/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
        Route::post('{id}', [PengembalianController::class, 'store'])->name('pengembalian.store');
    });



    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/barang', [LaporanController::class, 'laporanBarang'])->name('laporan.barang');
    Route::get('/laporan/pengembalian', [LaporanController::class, 'pengembalian'])->name('laporan.pengembalian');

    Route::get('/laporan/peminjaman/export/pdf', [LaporanController::class, 'exportPeminjamanPDF'])->name('laporan.peminjaman.pdf');
    Route::get('/laporan/peminjaman/export/excel', [LaporanController::class, 'exportPeminjamanExcel'])->name('laporan.peminjaman.excel');

    Route::get('/laporan/pengembalian/export/pdf', [LaporanController::class, 'exportPengembalianPDF'])->name('laporan.pengembalian.pdf');
    Route::get('/laporan/pengembalian/export/excel', [LaporanController::class, 'exportPengembalianExcel'])->name('laporan.pengembalian.excel');

    Route::get('/laporan/barang/export/pdf', [LaporanController::class, 'exportBarangPDF'])->name('laporan.barang.pdf');
    Route::get('/laporan/barang/export/excel', [LaporanController::class, 'exportBarangExcel'])->name('laporan.barang.excel');




});

 Route::prefix('laporan')->group(function () {
    Route::get('/peminjaman/export/excel', [LaporanController::class, 'exportPeminjamanExcel']);
    Route::get('/pengembalian/export/excel', [LaporanController::class, 'exportPengembalianExcel']);
    Route::get('/barang/export/excel', [LaporanController::class, 'exportBarangExcel']);
    Route::get('/laporan/barang/export/excel', [LaporanController::class, 'exportBarangExcel'])->name('laporan.barang.excel');
    Route::get('/laporan/peminjaman/export/excel', [LaporanController::class, 'exportPeminjamanExcel'])->name('laporan.peminjaman.excel');
    Route::get('/laporan/pengembalian/export/excel', [LaporanController::class, 'exportPengembalianExcel'])->name('laporan.pengembalian.excel');

});
