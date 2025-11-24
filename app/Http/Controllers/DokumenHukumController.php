<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_id', 'kategori_id', 'status'];
        $searchableColumns = ['nomor', 'judul', 'ringkasan'];

        $query = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->dateRange($request->start_date, $request->end_date);

        // Handle sorting dengan match expression (PHP 8.0+)
        $sortOrder = match($request->sort) {
            'judul_asc' => ['judul', 'asc'],
            'judul_desc' => ['judul', 'desc'],
            'tanggal_terbaru' => ['tanggal', 'desc'],
            'tanggal_terlama' => ['tanggal', 'asc'],
            'nomor_asc' => ['nomor', 'asc'],
            'nomor_desc' => ['nomor', 'desc'],
            'terbaru' => ['created_at', 'desc'],
            'terlama' => ['created_at', 'asc'],
            default => ['created_at', 'desc']
        };

        $query->orderBy($sortOrder[0], $sortOrder[1]);

        $dataDokumenHukum = $query->paginate(12)->withQueryString();

        // Get filter options
        $data = [
            'dataDokumenHukum' => $dataDokumenHukum,
            'dataJenisDokumen' => JenisDokumen::all(),
            'dataKategoriDokumen' => KategoriDokumen::all(),
            'totalDokumen' => DokumenHukum::count(),
            'dokumenAktif' => DokumenHukum::where('status', 'aktif')->count(),
            'dokumenTidakAktif' => DokumenHukum::where('status', 'tidak_aktif')->count(),
            'dokumenBulanIni' => DokumenHukum::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count()
        ];

        return view('pages.guest.dokumen_hukum.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'dataJenisDokumen' => JenisDokumen::all(),
            'dataKategoriDokumen' => KategoriDokumen::all()
        ];

        return view('pages.guest.dokumen_hukum.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_id' => 'required|exists:jenis_dokumen,id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor' => 'required|unique:dokumen_hukum|max:255',
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $dokumenHukum = DokumenHukum::create($validatedData);

        // Handle file upload menggunakan when()
        $request->whenFilled('file', function($file) use ($dokumenHukum) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('dokumen_hukum', $fileName, 'public');

            // Simpan informasi file ke database jika menggunakan media library
            $dokumenHukum->addMedia($file->getRealPath())
                ->usingName($file->getClientOriginalName())
                ->usingFileName($fileName)
                ->toMediaCollection('dokumen_hukum');
        });

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataDokumenHukum = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
            ->findOrFail($id);

        return view('pages.guest.dokumen_hukum.show', [
            'dataDokumenHukum' => $dataDokumenHukum
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'dataDokumenHukum' => DokumenHukum::findOrFail($id),
            'dataJenisDokumen' => JenisDokumen::all(),
            'dataKategoriDokumen' => KategoriDokumen::all()
        ];

        return view('pages.guest.dokumen_hukum.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dokumenHukum = DokumenHukum::findOrFail($id);

        $validatedData = $request->validate([
            'jenis_id' => 'required|exists:jenis_dokumen,id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor' => 'required|max:255|unique:dokumen_hukum,nomor,' . $id . ',dokumen_id',
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $dokumenHukum->update($validatedData);

        // Handle file upload menggunakan when()
        $request->whenFilled('file', function($file) use ($dokumenHukum) {
            // Delete existing file
            $dokumenHukum->clearMediaCollection('dokumen_hukum');

            // Add new file
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('dokumen_hukum', $fileName, 'public');

            $dokumenHukum->addMedia($file->getRealPath())
                ->usingName($file->getClientOriginalName())
                ->usingFileName($fileName)
                ->toMediaCollection('dokumen_hukum');
        });

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil diubah!');
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

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil dihapus!');
    }
}
