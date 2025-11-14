<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('pages.auth.login-form');
    }


    /**
     * Handle logika form login
     */
  /**
 * Handle logika form login
 */
public function login(Request $request)
{
    $request->validate([
        'username' => 'required|max:20',
        'password' => 'required|min:3|regex:/[A-Z]/',
    ], [
        'username.required' => 'Username tidak boleh kosong',
        'username.max' => 'Username maksimal 20 karakter',
        'password.required' => 'Password tidak boleh kosong',
        'password.min' => 'Password minimal 3 karakter',
        'password.regex' => 'Password harus mengandung setidaknya satu huruf kapital'
    ]);

    // Redirect ke halaman home setelah login berhasil
    return redirect()->route('home.index') // atau '/' sesuai route home Anda
        ->with('success', 'Login berhasil! Selamat datang.');
}
    /**
     * Handle logika form register (CREATE User)
     */
    public function register(Request $request)
    {
        // Validasi custom untuk nama (tidak mengandung angka)
        Validator::extend('no_numbers', function ($attribute, $value, $parameters, $validator) {
            return !preg_match('/[0-9]/', $value);
        });

        // Validasi data
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|no_numbers',
            'email' => 'required|email|max:100|unique:users,email',
            // 'username' => 'required|max:20',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/',
            ],
            'password_confirmation' => 'required|same:password',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 50 karakter',
            'name.no_numbers' => 'Nama tidak boleh mengandung angka',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 100 karakter',
            'email.unique' => 'Email sudah digunakan',
            'username.required' => 'Username tidak boleh kosong',
            'username.max' => 'Username maksimal 20 karakter',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 3 karakter',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf kapital',
            'password_confirmation.same' => 'Konfirmasi password tidak sesuai',
        ]);

        // Cek validasi
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data ke database (CREATE User)
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')
                ->with('success', 'Registrasi berhasil! Silakan Login');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['registration_error' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Handle logout
     */
    public function logout()
{
    session()->forget(['admin_logged_in', 'admin_username', 'admin_email', 'admin_role']);
    return redirect()->route('login-form') // PERBAIKAN: hapus 'auth.'
        ->with('success', 'Anda telah logout!');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
