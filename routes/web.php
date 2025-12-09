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

/*
|--------------------------------------------------------------------------
| Public Routes (Akses Tanpa Login / Guest)
|--------------------------------------------------------------------------
*/
// Home (Root /), Dokumen Hukum Public (Index/Show), dan Tentang
Route::resource('/', HomeController::class)->only(['index']);
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::resource('dokumen-hukum', DokumenHukumController::class)->only(['index', 'show']);

// Otentikasi
Route::get('/login', [AuthController::class, 'index'])->name('login-form');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


/*
|--------------------------------------------------------------------------
| 2. PROTECTED ROUTES (Harus Login Dulu)
|--------------------------------------------------------------------------
| Middleware: checkislogin
*/
Route::middleware(['checkislogin'])->group(function () {

    // Logout (Semua user login butuh ini)
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Home (Setelah login diarahkan kesini)
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    /*
    |--------------------------------------------------------------------------
    | A. GROUP KHUSUS ADMIN
    |--------------------------------------------------------------------------
    | Hanya ADMIN murni yang boleh akses Master Data ini.
    */
    Route::middleware(['checkrole:admin'])->group(function () {
        Route::resource('jenis-dokumen', JenisDokumenController::class);
        Route::resource('kategori-dokumen', KategoriDokumenController::class);

        // Dokumen Hukum (Admin bisa Tambah, Edit, Hapus)
        // Kita pakai 'except' index & show karena sudah ada di Public Routes di atas
        Route::resource('dokumen-hukum', DokumenHukumController::class)->except(['index', 'show']);
    });

    /*
    |--------------------------------------------------------------------------
    | B. GROUP WARGA (CRUD Warga)
    |--------------------------------------------------------------------------
    | Middleware: checkrole:warga
    | EFEK: Warga bisa masuk, DAN Admin juga bisa masuk (karena logic CheckRole tadi)
    */
    Route::middleware(['checkrole:warga'])->group(function () {
        Route::resource('warga', WargaController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | C. GROUP USER (CRUD User)
    |--------------------------------------------------------------------------
    | Middleware: checkrole:user
    | EFEK: User 'user' bisa masuk, DAN Admin juga bisa masuk.
    */
    Route::middleware(['checkrole:user'])->group(function () {
        Route::resource('user', UserController::class);
    });

});


