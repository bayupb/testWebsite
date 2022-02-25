<?php

use App\Http\Livewire\Agama;
use App\Http\Livewire\Jabatan;
use App\Http\Livewire\Pegawai;
use App\Http\Livewire\Golongan;
use App\Http\Livewire\Penempatan;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');
    Route::get('agama', Agama::class)->name('agama');
    Route::get('penempatan', Penempatan::class)->name('penempatan');
    Route::get('golongan', Golongan::class)->name('golongan');
    Route::get('jabatan', Jabatan::class)->name('jabatan');
    Route::get('pegawai', Pegawai::class)->name('pegawai');
});
