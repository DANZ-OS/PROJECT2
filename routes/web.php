<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Resources\KegiatanResource;
use App\Http\Controllers\KegiatanController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
         Route::get('/kegiatan', [KegiatanResource::class, 'index'])->name('kegiatan.index');
         Route::get('/kegiatan/create', [KegiatanResource::class, 'create'])->name('kegiatan.create');
         Route::post('/kegiatan', [KegiatanResource::class, 'store'])->name('kegiatan.store');
     });

// Rute untuk menampilkan daftar kegiatan (sudah ada)
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');

// Rute untuk MENYIMPAN data dari form (WAJIB ADA)
Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');

// Jangan lupa juga untuk memproteksi rute ini dengan middleware auth
// Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store')->middleware('auth');