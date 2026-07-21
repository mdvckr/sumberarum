<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\WargaAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\PetugasAuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduan;
use App\Http\Controllers\Admin\VerifikasiWargaController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\PengaduanController as PetugasPengaduan;

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::prefix('warga')->name('warga.')->group(function () {
    Route::get('/register', [WargaAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [WargaAuthController::class, 'register']);
    Route::get('/login', [WargaAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [WargaAuthController::class, 'login']);
    Route::post('/logout', [WargaAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:warga')->group(function () {
        Route::get('/dashboard', [WargaController::class, 'dashboard'])->name('dashboard');
        Route::get('/pengaduan/buat', [WargaController::class, 'buatPengaduan'])->name('pengaduan.buat');
        Route::post('/pengaduan/simpan', [WargaController::class, 'simpanPengaduan'])->name('pengaduan.simpan');
        Route::get('/pengaduan/{id}', [WargaController::class, 'detailPengaduan'])->name('pengaduan.detail');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        
        // Verifikasi Warga
        Route::get('/verifikasi', [VerifikasiWargaController::class, 'index'])->name('verifikasi.index');
        Route::post('/verifikasi/{id}', [VerifikasiWargaController::class, 'proses'])->name('verifikasi.proses');
        Route::post('/verifikasi/{id}/ajax', [VerifikasiWargaController::class, 'prosesAjax'])->name('verifikasi.ajax'); // Route tambahan untuk AJAX

        // Kelola Pengaduan Admin
        Route::get('/pengaduan', [AdminPengaduan::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [AdminPengaduan::class, 'detail'])->name('pengaduan.detail');
        Route::post('/pengaduan/{id}/validasi', [AdminPengaduan::class, 'validasi'])->name('pengaduan.validasi');
    });
});

Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/register', [PetugasAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [PetugasAuthController::class, 'register']);
    Route::get('/login', [PetugasAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [PetugasAuthController::class, 'login']);
    Route::post('/logout', [PetugasAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:petugas')->group(function () {
        Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
        Route::get('/pengaduan', [PetugasPengaduan::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [PetugasPengaduan::class, 'detail'])->name('pengaduan.detail');
        Route::post('/pengaduan/{id}/tanggapi', [PetugasPengaduan::class, 'tanggapi'])->name('pengaduan.tanggapi');
    });
});