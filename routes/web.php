<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\InteraksiController;
use App\Http\Controllers\AuthController;

// Route Halaman Depan (Landing Page)
Route::get('/', [FotoController::class, 'index']);

// Route untuk Autentikasi (Login, Register, Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang hanya bisa diakses setelah Login
Route::middleware(['auth'])->group(function () {
    
    // Dashboard / Home (bisa diarahkan ke galeri)
    Route::get('/home', [FotoController::class, 'index'])->name('home');

    // CRUD Foto
    Route::resource('foto', FotoController::class);
    
    // CRUD Album
    Route::resource('album', AlbumController::class);

    // Fitur Interaksi (Like dan Komentar)
    Route::post('/foto/{fotoId}/like', [InteraksiController::class, 'like'])->name('foto.like');
    Route::post('/foto/{fotoId}/komentar', [InteraksiController::class, 'komentar'])->name('foto.komentar');

});