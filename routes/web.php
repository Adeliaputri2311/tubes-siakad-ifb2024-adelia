<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use Illuminate\Support\Facades\Route;

// Rute Publik (Halaman Awal)
Route::get('/', function () {
    return view('welcome');
});

// Semua rute di bawah ini wajib Login
Route::middleware('auth')->group(function () {
    
    // Pengalih Dashboard Utama berdasarkan Role (Admin / Mahasiswa)
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('mahasiswa.dashboard');
    })->name('dashboard');

    // ==================== PANEL ADMIN ====================
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('dosen', DosenController::class);
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('matakuliah', MatakuliahController::class);
        Route::resource('jadwal', JadwalController::class);
    });

    // ==================== PANEL MAHASISWA ====================
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', function () {
            return view('mahasiswa.dashboard');
        })->name('dashboard');

        // Fitur Transaksional KRS
        Route::get('/krs/cetak', [KrsController::class, 'cetak'])->name('krs.cetak');
        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
        Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
        Route::delete('/krs/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');
    });

    // Rute Profil Bawaan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';