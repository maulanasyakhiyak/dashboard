<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['cekrole:kaprodi', 'auth'])->group(function () {
    Route::get('/kaprodi', [KaprodiController::class, 'index'])->name('Dashboardkaprodi');
    Route::get('/kaprodi/kelas', [KaprodiController::class, 'kelas'])->name('Kelaskaprodi');
    Route::get('/kaprodi/kelas/tambah-kelas', [KaprodiController::class, 'TambahKelas'])->name('TambahKelasKaprodi');
    Route::get('/kaprodi/kelas/edit-kelas/{id}', [KaprodiController::class, 'editKelas'])->name('editKelasKaprodi');
    Route::get('/kaprodi/dosen', [KaprodiController::class, 'dosen'])->name('Dosenkaprodi');
    Route::get('/kaprodi/mahasiswa', [KaprodiController::class, 'mahasiswa'])->name('Mahasiswakaprodi');
    Route::get('/search', [KaprodiController::class, 'search']);
    Route::post('/procces/tambah-kelas', [KaprodiController::class, 'proccesTambahKelas'])->name('procces-tambah-kelas');
    Route::post('/procces/update-kelas', [KaprodiController::class, 'proccesUpdateKelas'])->name('procces-update-kelas');
});

Route::middleware(['cekrole:dosen'])->group(function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('DashboardDosen')->middleware('auth');
});

Route::middleware(['cekrole:mahasiswa'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('DashboardMahasiswa')->middleware('auth');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'loginProses'])->name('loginProses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
