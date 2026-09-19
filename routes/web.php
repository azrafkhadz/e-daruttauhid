<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\AdminController; // <-- Jangan lupa tambahkan ini
use App\Http\Controllers\AuthController;

// Jika user mengakses halaman awal, langsung arahkan ke Dashboard Utama Admin
Route::get('/', function () {
    return redirect('/perizinan/dashboard-utama');
});

// Membungkus semua rute di dalam awalan (prefix) /perizinan
Route::prefix('perizinan')->group(function () {

    // Dashboard Utama Admin
    Route::get('/dashboard-utama', [AdminController::class, 'index']);

    // Modul Perizinan & Telegram
    Route::get('/dashboard', [IzinController::class, 'index']);

    // Form Pengajuan (Gunakan yang mengarah ke Controller agar data santri muncul)
    Route::get('/pengajuan', [IzinController::class, 'create']);
    Route::post('/pengajuan', [IzinController::class, 'simpanData']);

    Route::post('/konfirmasi/{id}', [IzinController::class, 'konfirmasiKembali']);

    // Edit & Update Izin
    Route::get('/izin/edit/{id}', [IzinController::class, 'edit']);
    Route::post('/izin/update/{id}', [IzinController::class, 'update']);
    // Riwayat Perizinan Keseluruhan
    Route::get('/riwayat', [IzinController::class, 'history']);
});

// Webhook Telegram (Dibiarkan di luar prefix agar bot Telegram mudah mengaksesnya)
Route::post('/webhook-telegram', [IzinController::class, 'webhook']);

// (Jika ada rute bawaan laravel seperti auth/inertia sebelumnya, bisa kamu biarkan di bawah sini)

// Rute Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Ubah redirect awal agar mengarah ke /login terlebih dahulu
Route::get('/', function () {
    return redirect('/login');
});

// ---------------------------------------------------
// RUTE SUPER ADMIN
// ---------------------------------------------------
Route::prefix('super-admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('super_admin.dashboard');
    });
});

// ---------------------------------------------------
// RUTE SANTRI
// ---------------------------------------------------
Route::prefix('santri')->group(function () {
    Route::get('/dashboard', function () {
        return view('santri.dashboard');
    });
});
