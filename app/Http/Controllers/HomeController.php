<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisDokumen;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Cek apakah user sudah login sesuai modul
        if(!Auth::check()){
            return redirect()->route('auth.index');
        }

        $data['dataJenisDokumen'] = JenisDokumen::all();
        return view('pages.guest.home', $data);
    }

    // ... other methods tetap sama
}
