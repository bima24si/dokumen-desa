<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisDokumen;
use App\Models\JenisSurat; // <--- PENTING: Jangan lupa baris ini!

class HomeController extends Controller
{
    public function index()
    {
        $dataJenisDokumen = JenisDokumen::all();
        
        // AMBIL DATA SURAT DARI DATABASE
        $dataSurat = JenisSurat::all(); 

        // KIRIM KE VIEW (tambahkan 'dataSurat')
        return view('pages.guest.home', compact('dataJenisDokumen', 'dataSurat'));
    }

    public function tentang()
    {
        return view('pages.guest.tentang');
    }
}