<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/{nidn}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{nidn}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{nidn}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

// Mahasiswa routes
Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul.index');
Route::get('/matkul/create', [MatkulController::class, 'create'])->name('matkul.create');
Route::post('/matkul', [MatkulController::class, 'store'])->name('matkul.store');
Route::get('/matkul/{nim}/edit', [matkulController::class, 'edit'])->name('matkul.edit');
Route::put('/matkul/{nim}', [MatkulController::class, 'update'])->name('matkul.update');
Route::delete('/matkul/{nim}', [MatkulController::class, 'destroy'])->name('matkul.destroy');
