<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DokumenHukumController;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\KategoriDokumenController;

Route::resource('/',HomeController::class);
// Route::resource('jenis-dokumen', JenisDokumenController::class);
Route::resource('dokumen', JenisDokumenController::class);


Route::resource('warga', WargaController::class);
Route::resource('user', UserController::class);
Route::resource('auth', AuthController::class);
Route::resource('/home', HomeController::class);
Route::resource('register', RegisterController::class);
// Tambahkan route login-form
Route::get('/login', [HomeController::class, 'index'])->name('home.index');
Route::get('/login', [AuthController::class, 'index'])->name('login-form');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/tentang', function () {
    return view('pages.guest.tentang');
})->name('tentang');

Route::resource('dokumen-hukum', DokumenHukumController::class);
// Tambahkan di routes/web.php
Route::resource('kategori-dokumen', KategoriDokumenController::class);
