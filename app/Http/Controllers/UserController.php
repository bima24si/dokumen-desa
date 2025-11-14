<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('pages.guest.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.guest.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'Penambahan Data User Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('pages.guest.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('pages.guest.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|confirmed',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Perubahan Data User Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Cek jika user mencoba menghapus dirinya sendiri
        if (auth()->id() == $id) {
            return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }
}
