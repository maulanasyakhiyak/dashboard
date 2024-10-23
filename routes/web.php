<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login', 301);

Route::get('/search', [KaprodiController::class, 'search']);

Route::middleware(['cekrole:kaprodi', 'auth'])->group(function () {
    Route::get('/kaprodi', [KaprodiController::class, 'index'])->name('Dashboardkaprodi');
    Route::get('/kaprodi/kelas', [KaprodiController::class, 'kelas'])->name('Kelaskaprodi');
    Route::get('/kaprodi/kelas/tambah-kelas', [KaprodiController::class, 'TambahKelas'])->name('TambahKelasKaprodi');
    Route::get('/kaprodi/kelas/edit-kelas/{id}', [KaprodiController::class, 'editKelas'])->name('editKelasKaprodi');
    Route::get('/kaprodi/dosen', [KaprodiController::class, 'dosen'])->name('Dosenkaprodi');
    Route::get('/kaprodi/mahasiswa', [KaprodiController::class, 'mahasiswa'])->name('Mahasiswakaprodi');
    Route::post('/procces/tambah-kelas', [KaprodiController::class, 'proccesTambahKelas'])->name('procces-tambah-kelas');
    Route::post('/procces/update-kelas', [KaprodiController::class, 'proccesUpdateKelas'])->name('procces-update-kelas');
    Route::delete('/delete/delete-kelas/{id}', [KaprodiController::class, 'proccesDeleteKelas'])->name('procces-delete-kelas');
    Route::delete('/delete/delete-mahasiswa-from-class/{id}', [KaprodiController::class, 'deleteMhsFromClass'])->name('deleteMhsFromClass');

    // DOSEN
    Route::post('/kaprodi/dosen/tambah', [KaprodiController::class, 'tambah_dosen'])->name('tambah_dosen');
    Route::post('/kaprodi/dosen/edit/{kode_dosen}', [KaprodiController::class, 'edit_dosen'])->name('edit_dosen');
    Route::delete('/kaprodi/dosen/delete/{id}', [KaprodiController::class, 'delete_dosen'])->name('delete_dosen');
});

Route::middleware(['cekrole:dosen', 'auth'])->group(function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('DashboardDosen');
    Route::get('/dosen/editMahasiswa/{kelas_id}', [DosenController::class, 'editMahasiswa'])->name('editMahasiswa');
    Route::post('/dosen/editMahasiswa/procces/{kelas_id}', [DosenController::class, 'editMahasiswaProcces'])->name('editMahasiswaProcces');
    Route::post('/dosen/emit/mahasiswa/{id}', [DosenController::class, 'emitMahasiswa'])->name('emitMahasiswa');
    Route::post('/dosen/tambahMahasiswa/{kelas_id}', [DosenController::class, 'tambahMahasiswa'])->name('tambahMahasiswa');
    Route::post('/dosen/req/accept/{id}', [DosenController::class, 'accept_req'])->name('accept_req');
    Route::post('/dosen/req/reject/{id}', [DosenController::class, 'reject_req'])->name('reject_req');
});

Route::middleware(['cekrole:mahasiswa', 'auth'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('DashboardMahasiswa');
    Route::get('/mahasiswa/edit', [MahasiswaController::class, 'editMahasiswa'])->name('mahasiswa.editMahasiswa')->middleware('cek_request');
    Route::post('/mahasiswa/edit/process', [MahasiswaController::class, 'editMahasiswaProcces'])->name('mahasiswa.editMahasiswaProcces');
    Route::post('/mahasiswa/request-edit/{id}', [MahasiswaController::class, 'requestEditMhs'])->name('requestEditMhs');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'loginProses'])->name('loginProses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
