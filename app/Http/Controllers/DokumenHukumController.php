<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Storage;
=======
>>>>>>> 1ef3240d53deee62a72bf7cb6cd04e48baa765ca

class DokumenHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
<<<<<<< HEAD
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

=======
    public function index()
    {
        $data['dataDokumenHukum'] = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])->get();
>>>>>>> 1ef3240d53deee62a72bf7cb6cd04e48baa765ca
        return view('pages.guest.dokumen_hukum.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
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
=======
        $data['dataJenisDokumen'] = JenisDokumen::all();
        $data['dataKategoriDokumen'] = KategoriDokumen::all();
        return view('pages.guest.dokumen_hukum.create', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_id' => 'required|exists:jenis_dokumen,id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id', // PERBAIKAN: kategori_id
>>>>>>> 1ef3240d53deee62a72bf7cb6cd04e48baa765ca
            'nomor' => 'required|unique:dokumen_hukum|max:255',
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

<<<<<<< HEAD
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
=======
        DokumenHukum::create($data);

        return redirect()->route('dokumen-hukum.index')->with('success', 'Dokumen hukum berhasil ditambahkan!');
>>>>>>> 1ef3240d53deee62a72bf7cb6cd04e48baa765ca
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
<<<<<<< HEAD
        $dataDokumenHukum = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
            ->findOrFail($id);

        return view('pages.guest.dokumen_hukum.show', [
            'dataDokumenHukum' => $dataDokumenHukum
        ]);
=======
        $data['dataDokumenHukum'] = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
            ->findOrFail($id);
        return view('pages.guest.dokumen_hukum.show', $data);
>>>>>>> 1ef3240d53deee62a72bf7cb6cd04e48baa765ca
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
<<<<<<< HEAD
        $data = [
            'dataDokumenHukum' => DokumenHukum::findOrFail($id),
            'dataJenisDokumen' => JenisDokumen::all(),
            'dataKategoriDokumen' => KategoriDokumen::all()
        ];

=======
        $data['dataDokumenHukum'] = DokumenHukum::findOrFail($id);
        $data['dataJenisDokumen'] = JenisDokumen::all();
        $data['dataKategoriDokumen'] = KategoriDokumen::all();
>>>>>>> 1ef3240d53deee62a72bf7cb6cd04e48baa765ca
        return view('pages.guest.dokumen_hukum.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dokumenHukum = DokumenHukum::findOrFail($id);

<<<<<<< HEAD
        $validatedData = $request->validate([
            'jenis_id' => 'required|exists:jenis_dokumen,id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
=======
        $data = $request->validate([
            'jenis_id' => 'required|exists:jenis_dokumen,id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id', // PERBAIKAN: kategori_id (bukan id)
>>>>>>> 1ef3240d53deee62a72bf7cb6cd04e48baa765ca
            'nomor' => 'required|max:255|unique:dokumen_hukum,nomor,' . $id . ',dokumen_id',
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

<<<<<<< HEAD
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
=======
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
>>>>>>> 1ef3240d53deee62a72bf7cb6cd04e48baa765ca
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

<<<<<<< HEAD
        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil dihapus!');
    }
}
=======
        return redirect()->route('dokumen-hukum.index')->with('success', 'Dokumen hukum berhasil dihapus!');
    }
}   
>>>>>>> 1ef3240d53deee62a72bf7cb6cd04e48baa765ca
