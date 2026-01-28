<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = [];
        $searchableColumns = ['name', 'email'];

        $query = User::query()
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns);

        $query->orderBy('created_at', 'desc');

        $data = [
            'dataUser' => $query->paginate(12)->withQueryString(),
            'totalUsers' => User::count(),
        ];

        return view('pages.guest.user.index', $data);
    }

    public function create()
    {
        return view('pages.guest.user.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,warga,user',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Hash Password
        $validatedData['password'] = Hash::make($request->password);

        // Simpan Role lowercase agar konsisten
        $validatedData['role'] = strtolower($request->role);

        // Handle Upload Foto
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $path;
        }

        User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'Penambahan Data User Berhasil!');
    }

    public function show(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('pages.guest.user.show', $data);
    }

    public function edit(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('pages.guest.user.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,warga,user',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:6|confirmed';
        }

        $validatedData = $request->validate($rules);

        // Handle Password
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        // Handle Role
        if ($request->filled('role')) {
            $validatedData['role'] = strtolower($request->role);
        }

        // Handle Photo Update
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $path;
        }

        $user->update($validatedData);

        return redirect()->route('user.index')->with('success', 'User berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $id) {
            return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        // Hapus file foto dari storage
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }
}
