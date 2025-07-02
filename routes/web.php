<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\SkController;
use App\Http\Controllers\SkProcessController;
use App\Http\Controllers\PbController;
use App\Http\Controllers\PbProcessController;
use App\Http\Controllers\LainController;
use App\Http\Controllers\LainProcessController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dalam sebuah grup yang
| berisi middleware group "web".
|
*/

// Rute default, mengarahkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Grup rute yang memerlukan otentikasi (pengguna harus sudah login)
Route::middleware('auth')->group(function () {

    // Dashboard utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute untuk manajemen profil pengguna (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ===================================================
    // RUTE KHUSUS ADMIN
    // ===================================================
    Route::middleware('role:admin')->group(function () {
        Route::resource('opd', OpdController::class);
        Route::resource('assistants', AssistantController::class);
        // Tambahkan rute untuk manajemen user jika diperlukan
    });

    // ===================================================
    // RUTE UNTUK ADMIN & USER HUKUM
    // ===================================================
    Route::middleware('role:admin,userhukum')->group(function () {
        // --- Manajemen SK ---
        Route::get('/sk', [SkController::class, 'index'])->name('sk.index');
        Route::get('/sk/{sk}', [SkController::class, 'show'])->name('sk.show');
        Route::post('/sk/{sk}/process', [SkProcessController::class, 'update'])->name('sk.process.update');
        Route::post('/sk/{sk}/cancel', [SkProcessController::class, 'cancel'])->name('sk.process.cancel');
        
        // --- Manajemen PB ---
        Route::get('/pb', [PbController::class, 'index'])->name('pb.index');
        Route::get('/pb/{pb}', [PbController::class, 'show'])->name('pb.show');
        Route::post('/pb/{pb}/process', [PbProcessController::class, 'update'])->name('pb.process.update');
        Route::post('/pb/{pb}/cancel', [PbProcessController::class, 'cancel'])->name('pb.process.cancel');
        
        // --- Manajemen Produk Lainnya ---
        Route::get('/lain', [LainController::class, 'index'])->name('lain.index');
        Route::get('/lain/{lain}', [LainController::class, 'show'])->name('lain.show');
        Route::post('/lain/{lain}/process', [LainProcessController::class, 'update'])->name('lain.process.update');
        Route::post('/lain/{lain}/cancel', [LainProcessController::class, 'cancel'])->name('lain.process.cancel');

        // --- Peminjaman (Bon) ---
        // Menampilkan form peminjaman
        Route::get('/{type}/{id}/bon/create', [BonController::class, 'create'])->name('bon.create');
        Route::post('/bon', [BonController::class, 'store'])->name('bon.store');
        // Menampilkan daftar peminjaman
        Route::get('/bon', [BonController::class, 'index'])->name('bon.index');
        // Mengupdate tanggal kembali
        Route::patch('/bon/{bon}', [BonController::class, 'update'])->name('bon.update');

        // --- Cetak Dokumen ---
        Route::get('/print/sk/{sk}', [PrintController::class, 'skCard'])->name('print.sk.card');
        Route::get('/print/pb/{pb}', [PrintController::class, 'pbCard'])->name('print.pb.card');
        Route::get('/print/receipt/sk/{sk}', [PrintController::class, 'receipt'])->name('print.sk.receipt');

        // --- Laporan ---
        Route::get('/reports/sk', [ReportController::class, 'skReportForm'])->name('report.sk.form');
        Route::post('/reports/sk', [ReportController::class, 'generateSkReport'])->name('report.sk.generate');
        // Tambahkan rute untuk laporan PB dan Lainnya
    });

    // ===================================================
    // RUTE KHUSUS USER OPD
    // ===================================================
    Route::middleware('role:user')->group(function () {
        // --- Pengajuan SK ---
        Route::get('/pengajuan-saya/sk', [SkController::class, 'mySubmissions'])->name('sk.mine');
        Route::get('/pengajuan/sk/create', [SkController::class, 'create'])->name('sk.create');
        Route::post('/pengajuan/sk', [SkController::class, 'store'])->name('sk.store');

        // --- Pengajuan PB ---
        Route::get('/pengajuan-saya/pb', [PbController::class, 'mySubmissions'])->name('pb.mine');
        Route::get('/pengajuan/pb/create', [PbController::class, 'create'])->name('pb.create');
        Route::post('/pengajuan/pb', [PbController::class, 'store'])->name('pb.store');

        // --- Pengajuan Lainnya ---
        Route::get('/pengajuan-saya/lain', [LainController::class, 'mySubmissions'])->name('lain.mine');
        Route::get('/pengajuan/lain/create', [LainController::class, 'create'])->name('lain.create');
        Route::post('/pengajuan/lain', [LainController::class, 'store'])->name('lain.store');
    });

});


// Memuat rute otentikasi dari Laravel Breeze
require __DIR__.'/auth.php';