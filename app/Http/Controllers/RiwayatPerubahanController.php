<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPerubahan;
use Illuminate\Http\Request;

class RiwayatPerubahanController extends Controller
{
    // Menampilkan halaman index
    public function index()
    {
        // Mengambil data urut dari yang terbaru, 10 data per halaman
        $riwayats = RiwayatPerubahan::with('user')->latest()->paginate(10);
        return view('pages.guest.riwayat_perubahan.index', compact('riwayats'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('pages.guest.riwayat_perubahan.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'aksi' => 'required|string|max:255',
            'entitas' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        RiwayatPerubahan::create([
            'user_id' => auth()->id(), // User yang sedang login
            'aksi' => $request->aksi,
            'entitas' => $request->entitas,
            'keterangan' => $request->keterangan,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('riwayat-perubahan.index')->with('success', 'Riwayat berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $riwayat = RiwayatPerubahan::findOrFail($id);
        return view('pages.guest.riwayat_perubahan.edit', compact('riwayat'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'aksi' => 'required|string|max:255',
            'entitas' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $riwayat = RiwayatPerubahan::findOrFail($id);
        $riwayat->update([
            'aksi' => $request->aksi,
            'entitas' => $request->entitas,
            'keterangan' => $request->keterangan,
            // User ID dan IP address biasanya tidak diubah saat edit log,
            // tapi bisa disesuaikan jika perlu mencatat "siapa yang mengedit log".
        ]);

        return redirect()->route('riwayat-perubahan.index')->with('success', 'Riwayat berhasil diperbarui.');
    }

    // Menghapus data
    public function destroy($id)
    {
        $riwayat = RiwayatPerubahan::findOrFail($id);
        $riwayat->delete();

        return redirect()->route('riwayat-perubahan.index')->with('success', 'Riwayat berhasil dihapus.');
    }
}
