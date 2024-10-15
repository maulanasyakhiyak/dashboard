<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function(){
    return redirect('login');
});

Route::middleware(['cekrole:kaprodi'])->group(function () {
    Route::get('/kaprodi',[KaprodiController::class,'index'])->name('Dashboardkaprodi')->middleware('auth');
    Route::get('/kaprodi/kelas',[KaprodiController::class,'kelas'])->name('Kelaskaprodi')->middleware('auth');
    Route::get('/kaprodi/kelas/tambah-kelas',[KaprodiController::class,'TambahKelas'])->name('TambahKelasKaprodi');
    Route::get('/kaprodi/dosen',[KaprodiController::class,'dosen'])->name('Dosenkaprodi')->middleware('auth');
    Route::get('/kaprodi/mahasiswa',[KaprodiController::class,'mahasiswa'])->name('Mahasiswakaprodi')->middleware('auth');
});

Route::middleware(['cekrole:dosen'])->group(function () {
    Route::get('/dosen',[DosenController::class,'index'])->name('DashboardDosen')->middleware('auth');
});

Route::middleware(['cekrole:mahasiswa'])->group(function () {
    Route::get('/mahasiswa',[MahasiswaController::class,'index'])->name('DashboardMahasiswa')->middleware('auth');
});

Route::get('/login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'loginProses'])->name('loginProses');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
