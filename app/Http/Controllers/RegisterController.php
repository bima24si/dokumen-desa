<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; // <--- WAJIB IMPORT INI

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required', 'string', 'min:3', 'confirmed',
                'regex:/[A-Z]/',
                'regex:/[0-3]/'
            ],
            // 2. Validasi Role (Sesuai dengan value di View: huruf kecil)
            'role' => ['required', 'string', Rule::in(['admin', 'user', 'warga'])],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'role.required' => 'Wajib memilih role pengguna.',
            'role.in' => 'Pilihan role tidak valid (Pilih: User, Warga, atau Admin).', // Pesan error kustom
            'password.regex' => 'Password harus mengandung huruf kapital dan angka.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // 3. Simpan User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // <--- PERBAIKAN UTAMA: Ambil dari request, JANGAN ditulis 'user'
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
