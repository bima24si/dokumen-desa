<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;

class DokumenHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataDokumenHukum'] = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])->get();
        return view('pages.guest.dokumen_hukum.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataJenisDokumen'] = JenisDokumen::all();
        $data['dataKategoriDokumen'] = KategoriDokumen::all();
        return view('pages.guest.dokumen_hukum.create', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_id' => 'required|exists:jenis_dokumen,id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id', // PERBAIKAN: kategori_id
            'nomor' => 'required|unique:dokumen_hukum|max:255',
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        DokumenHukum::create($data);

        return redirect()->route('dokumen-hukum.index')->with('success', 'Dokumen hukum berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['dataDokumenHukum'] = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
            ->findOrFail($id);
        return view('pages.guest.dokumen_hukum.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataDokumenHukum'] = DokumenHukum::findOrFail($id);
        $data['dataJenisDokumen'] = JenisDokumen::all();
        $data['dataKategoriDokumen'] = KategoriDokumen::all();
        return view('pages.guest.dokumen_hukum.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dokumenHukum = DokumenHukum::findOrFail($id);

        $data = $request->validate([
            'jenis_id' => 'required|exists:jenis_dokumen,id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id', // PERBAIKAN: kategori_id (bukan id)
            'nomor' => 'required|max:255|unique:dokumen_hukum,nomor,' . $id . ',dokumen_id',
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $dokumenHukum->update($data);

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete existing file
            $dokumenHukum->clearMediaCollection('dokumen_hukum');
            // Add new file
            $file = $request->file('file');
            $dokumenHukum->addMedia($file)->toMediaCollection('dokumen_hukum');
        }

        return redirect()->route('dokumen-hukum.index')->with('success', 'Dokumen hukum berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokumenHukum = DokumenHukum::findOrFail($id);

        // Delete associated media files
        $dokumenHukum->clearMediaCollection('dokumen_hukum');

        $dokumenHukum->delete();

        return redirect()->route('dokumen-hukum.index')->with('success', 'Dokumen hukum berhasil dihapus!');
    }
}   
