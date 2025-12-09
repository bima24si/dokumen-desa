<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Pastikan User Login
        if (!Auth::check()) {
            return redirect()->route('login-form')->withErrors('Silahkan login terlebih dahulu!');
        }

        $user = Auth::user();

        // 2. LOGIKA ADMIN SAKTI (Super User)
        // Jika yang login adalah 'admin', izinkan akses ke MANAPUN tanpa cek role yang diminta
        if ($user->role === 'admin') {
            return $next($request);
        }

        // 3. Cek Role Sesuai Permintaan
        // Jika bukan admin, baru kita cek apakah role user sama dengan role route
        if ($user->role === $role) {
            return $next($request);
        }

        // 4. Jika gagal semua, tolak
        return abort(403, 'Akses ditolak. Anda tidak memiliki izin.');
    }
}
