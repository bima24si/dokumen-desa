<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home.index');
        }
        // PERBAIKAN: Gunakan 'auth.login' bukan 'pages.auth.login'
        return view('layouts.auth.login');
    }

   public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);

        // Update waktu login terakhir ke database
        $user->update([
            'last_login_at' => now()
        ]);

        return redirect()->route('home.index')->with('success', 'Login berhasil!');
    } else {
        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }
}

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();     // Hapus semua session
        $request->session()->regenerateToken(); // Cegah CSRF

        // Redirect ke halaman login
        return redirect()->route('login');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('pages.guest.profile', compact('user'));
    }
}


