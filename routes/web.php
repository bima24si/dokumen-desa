<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;




Route::resource('/',HomeController::class);


Route::resource('dokumen', JenisDokumenController::class);
Route::resource('warga', WargaController::class);
<<<<<<< HEAD
Route::resource('user', UserController::class);
Route::resource('auth', AuthController::class);
Route::resource('/home', HomeController::class);
Route::resource('register', RegisterController::class);
// Tambahkan route login-form
Route::get('/login', [HomeController::class, 'index'])->name('home.index');
Route::get('/login', [AuthController::class, 'index'])->name('login-form');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

=======
Route::get('/user', [UserController::class, 'index']);
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/layanan', [HomeController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466


