<?php
// [file name]: KategoriDokumenController.php

namespace App\Http\Controllers;

use App\Models\KategoriDokumen;
use Illuminate\Http\Request;

class KategoriDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = []; // Bisa ditambahkan jika ada kolom untuk filter
        $searchableColumns = ['nama', 'deskripsi'];

        $data['dataKategoriDokumen'] = KategoriDokumen::withCount('dokumenHukum')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('pages.guest.kategori_dokumen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.guest.kategori_dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|unique:kategori_dokumen|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriDokumen::create($data);

        return redirect()->route('kategori-dokumen.index')->with('success', 'Kategori dokumen berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['dataKategoriDokumen'] = KategoriDokumen::findOrFail($id);
        return view('pages.guest.kategori_dokumen.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataKategoriDokumen'] = KategoriDokumen::findOrFail($id);
        return view('pages.guest.kategori_dokumen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategoriDokumen = KategoriDokumen::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|max:255|unique:kategori_dokumen,nama,' . $id . ',kategori_id',
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriDokumen->update($data);

        return redirect()->route('kategori-dokumen.index')->with('success', 'Kategori dokumen berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoriDokumen = KategoriDokumen::findOrFail($id);

        // Cek apakah kategori digunakan di dokumen hukum
        if ($kategoriDokumen->dokumenHukum()->exists()) {
            return redirect()->route('kategori_dokumen.index')
                ->with('error', 'Tidak dapat menghapus kategori karena masih digunakan di dokumen hukum!');
        }

        $kategoriDokumen->delete();

        return redirect()->route('kategori-dokumen.index')->with('success', 'Kategori dokumen berhasil dihapus!');
    }
}
