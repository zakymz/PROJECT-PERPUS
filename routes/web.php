<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('buku')->group(function() {
    Route::get('delete/{id}', [BukuController::class, 'delete'])->name('buku.delete');
});

Route::prefix('anggota')->group(function() {
    Route::get('delete/{id}', [AnggotaController::class, 'delete'])->name('anggota.delete');
});

Route::prefix('pegawai')->group(function() {
    Route::get('delete/{id}', [PegawaiController::class, 'delete'])->name('pegawai.delete');
});

Route::prefix('transaction')->group(function() {
    Route::post('kembalikan_buku/{id}', [TransactionController::class, 'kembalikanBuku'])->name('transaction.kembalikan_buku');
    Route::post('buku_tidak_ada/{id}', [TransactionController::class, 'bukuTidakAda'])->name('transaction.buku_tidak_ada');
});

Route::prefix('laporan')->group(function() {
    Route::get('export', [LaporanController::class, 'export'])->name('laporan.export');
});

Route::prefix('katalog')->group(function() {
    Route::get('search', [KatalogController::class, 'search'])->name('katalog.search');
});

Route::resource('buku', BukuController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('anggota', AnggotaController::class);
Route::resource('transaction', TransactionController::class);
Route::resource('riwayat', RiwayatController::class);
Route::resource('laporan', LaporanController::class);
Route::resource('profil', ProfilController::class);
Route::resource('katalog', KatalogController::class);