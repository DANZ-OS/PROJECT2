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

Route::get('/kegiatan', [KegiatanController::class, 'index']);