<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisDokumenController;


Route::get('/', function () {
    return view('user.index');
});

Route::resource('dokumen', JenisDokumenController::class);
Route::resource('warga', WargaController::class);
Route::get('/user', [UserController::class, 'index']);
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/layanan', [HomeController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

Route::get('/', function () {
    return view('index');
})->name('home');

