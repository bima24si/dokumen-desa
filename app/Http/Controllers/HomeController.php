<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisDokumen; // PENTING: Import Model ini

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (Home)
     */
    public function index()
    {
        // Masalah Anda sebelumnya: Variabel ini tidak didefinisikan.
        // Solusi: Ambil data dari database.
        $dataJenisDokumen = JenisDokumen::all();

        // Kirim variabel ke view menggunakan compact
        return view('pages.guest.home', compact('dataJenisDokumen'));
    }

    /**
     * Menampilkan halaman Tentang
     * Masalah Anda sebelumnya: Fungsi ini TIDAK ADA.
     * Solusi: Tambahkan fungsi ini.
     */
    public function tentang()
    {
        return view('pages.guest.tentang');
    }
}
