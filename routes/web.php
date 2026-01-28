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
use App\Http\Controllers\LampiranDokumenController;
use App\Http\Controllers\RiwayatPerubahanController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Bisa Diakses Tanpa Login / Guest)
|--------------------------------------------------------------------------
*/

// Halaman Depan & Tentang
Route::get('/', [HomeController::class, 'index'])->name('landing');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');

// --- DOKUMEN HUKUM (PUBLIC) ---
// HANYA Index yang ditaruh di sini.
// Route 'show' (detail) kita taruh DI PALING BAWAH agar tidak memblokir route 'create'.
Route::get('/dokumen-hukum', [DokumenHukumController::class, 'index'])->name('dokumen-hukum.index');
Route::get('/dokumen-hukum/download-attachment/{id}', [DokumenHukumController::class, 'downloadAttachment'])
    ->name('dokumen-hukum.download-attachment');

// Auth (Login & Register)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login-form');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

/*
|--------------------------------------------------------------------------
| 2. PROTECTED ROUTES (Harus Login Dulu)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // --- Logout, Dashboard, Profil ---
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/profil', [AuthController::class, 'profile'])->name('profile');

    // --- Fitur Umum User Login ---
    Route::resource('riwayat-perubahan', RiwayatPerubahanController::class);
    Route::get('/dokumen', [JenisDokumenController::class, 'index'])->name('dokumen.index');

    // Download Dokumen Hukum (Member Only)
    Route::get('/dokumen-hukum/download/{file_number}', [DokumenHukumController::class, 'download'])
        ->name('dokumen-hukum.download');

    // --- LAMPIRAN DOKUMEN ---
    // Custom Download Route
    Route::get('lampiran-dokumen/{id}/download', [LampiranDokumenController::class, 'download'])
        ->name('lampiran-dokumen.download');

    // Resource Lampiran
    Route::resource('lampiran-dokumen', LampiranDokumenController::class)
        ->parameters(['lampiran-dokumen' => 'lampiran_dokumen']);

    /*
    |----------------------------------------------------------------------
    | A. GROUP ADMIN
    |----------------------------------------------------------------------
    */
    Route::middleware(['checkrole:admin'])->group(function () {
        Route::resource('jenis-dokumen', JenisDokumenController::class);
        Route::resource('kategori-dokumen', KategoriDokumenController::class);

        // --- DOKUMEN HUKUM (ADMIN) ---
        // Ini akan membuat route: create, store, edit, update, destroy
        // Route ini didefinisikan SEBELUM route 'show' public di bawah,
        // sehingga '/dokumen-hukum/create' akan masuk ke sini, bukan dianggap ID.
        Route::resource('dokumen-hukum', DokumenHukumController::class)->except(['index', 'show']);

        // CRUD User & Warga
        Route::resource('user', UserController::class);
        Route::resource('warga', WargaController::class);
    });

    /*
    |----------------------------------------------------------------------
    | B. GROUP WARGA
    |----------------------------------------------------------------------
    */
   Route::middleware(['checkrole:warga'])->group(function () {
        // Route khusus warga jika ada
    });

    Route::middleware(['checkrole:user'])->group(function () {
        // Jika admin juga butuh akses controller ini, pastikan logicnya benar.
        // Route::resource('user', UserController::class); // Hati-hati duplikasi nama route dengan admin
    });

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

    Route::middleware(['auth'])->group(function () {
        // Route untuk halaman profil
        Route::get('/profil', [AuthController::class, 'profile'])->name('profile');
        Route::resource('riwayat-perubahan', RiwayatPerubahanController::class);
        Route::resource('lampiran-dokumen', LampiranDokumenController::class);

        // ... route lain yang butuh login
    });


Route::middleware(['auth'])->group(function () {
    // Route untuk halaman profil
    Route::get('/profil', [AuthController::class, 'profile'])->name('profile');
    Route::resource('riwayat-perubahan', RiwayatPerubahanController::class);
    Route::get('/dokumen-hukum/download/{file_number}', [DokumenHukumController::class, 'download'])
        ->name('dokumen-hukum.download');
    // --- TAMBAHKAN INI ---
    Route::get('lampiran-dokumen/{id}/download', [LampiranDokumenController::class, 'download'])
        ->name('lampiran-dokumen.download');
    // ---------------------

    Route::resource('lampiran-dokumen', LampiranDokumenController::class);
    Route::get('/dokumen', [JenisDokumenController::class, 'index'])->name('dokumen.index');

    // ... route lain yang butuh login
});

/*
|--------------------------------------------------------------------------
| 3. PUBLIC FALLBACK (Ditaruh paling bawah)
|--------------------------------------------------------------------------
*/

// PENTING: Route ini menangkap /dokumen-hukum/{id}.
// Kita taruh paling bawah supaya kata kunci seperti 'create' atau 'download'
// yang ada di atas TIDAK dianggap sebagai {id}.
Route::get('/dokumen-hukum/{dokumen_hukum}', [DokumenHukumController::class, 'show'])
    ->name('dokumen-hukum.show');
