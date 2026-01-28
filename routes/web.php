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

// --- DOKUMEN HUKUM (PUBLIC READ-ONLY) ---
Route::get('/dokumen-hukum', [DokumenHukumController::class, 'index'])->name('dokumen-hukum.index');

// Download Lampiran (Bisa diakses publik atau mau dibatasi? Di sini saya set publik)
Route::get('/dokumen-hukum/download-attachment/{id}', [DokumenHukumController::class, 'downloadAttachment'])
    ->name('dokumen-hukum.download-attachment');

// --- AUTHENTICATION ---
Route::middleware(['guest'])->group(function () {
    // PENTING: name('login') wajib ada untuk redirect otomatis middleware auth
    Route::get('/login', [AuthController::class, 'index'])->name('login');
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

    // --- FITUR UMUM (Semua User Login) ---
    Route::resource('riwayat-perubahan', RiwayatPerubahanController::class);
    Route::get('/dokumen', [JenisDokumenController::class, 'index'])->name('dokumen.index');

    // Download File Utama Dokumen Hukum (Hanya Member)
    Route::get('/dokumen-hukum/download/{file_number}', [DokumenHukumController::class, 'download'])
        ->name('dokumen-hukum.download');

    // --- LAMPIRAN DOKUMEN ---
    // Custom Download Route (Harus sebelum resource agar tidak dianggap ID)
    Route::get('lampiran-dokumen/{id}/download', [LampiranDokumenController::class, 'download'])
        ->name('lampiran-dokumen.download');

    // Resource Lampiran
    Route::resource('lampiran-dokumen', LampiranDokumenController::class)
        ->parameters(['lampiran-dokumen' => 'lampiran_dokumen']);

    /*
    |----------------------------------------------------------------------
    | A. GROUP ADMIN (Akses Penuh)
    |----------------------------------------------------------------------
    */
    Route::middleware(['checkrole:admin'])->group(function () {
        // Master Data
        Route::resource('jenis-dokumen', JenisDokumenController::class);
        Route::resource('kategori-dokumen', KategoriDokumenController::class);

        // Dokumen Hukum (Admin: Create, Store, Edit, Update, Destroy)
        // Kita exclude 'index' dan 'show' karena sudah ada di Public & Fallback
        Route::resource('dokumen-hukum', DokumenHukumController::class)
            ->except(['index', 'show']);

        // Manajemen User & Warga
        Route::resource('user', UserController::class);
        Route::resource('warga', WargaController::class);
    });

    /*
    |----------------------------------------------------------------------
    | B. GROUP USER / WARGA (Jika Ada Akses Khusus)
    |----------------------------------------------------------------------
    */
    Route::middleware(['checkrole:warga'])->group(function () {
        // Tambahkan route khusus warga di sini jika ada
    });

});

/*
|--------------------------------------------------------------------------
| 3. PUBLIC FALLBACK (Detail Dokumen)
|--------------------------------------------------------------------------
| Ditaruh PALING BAWAH.
| Tujuannya: Agar URL seperti /dokumen-hukum/create (punya admin)
| TIDAK dianggap sebagai {id} dokumen.
*/
Route::get('/dokumen-hukum/{dokumen_hukum}', [DokumenHukumController::class, 'show'])
    ->name('dokumen-hukum.show');
