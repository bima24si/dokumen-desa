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
        $filterableColumns = ['jenis_id', 'kategori_id', 'status', 'file_type']; // Tambahkan file_type
        $searchableColumns = ['nomor', 'judul', 'ringkasan', 'file_number']; // Tambahkan file_number

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
            'file_number_asc' => ['file_number', 'asc'],
            'file_number_desc' => ['file_number', 'desc'],
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
            'dokumenUtama' => DokumenHukum::where('file_type', 'utama')->count(),
            'dokumenLampiran' => DokumenHukum::where('file_type', 'lampiran')->count(),
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
            'dataKategoriDokumen' => KategoriDokumen::all(),
            'fileNumber' => DokumenHukum::generateFileNumber('utama') // Generate preview
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
            'file_type' => 'required|in:utama,lampiran',
            'file_number' => 'nullable|unique:dokumen_hukum,file_number|max:50',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

<<<<<<< HEAD
        // Generate file_number jika tidak diisi
        if (empty($validatedData['file_number'])) {
            $validatedData['file_number'] = DokumenHukum::generateFileNumber($validatedData['file_type']);
        }

=======
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252
        $dokumenHukum = DokumenHukum::create($validatedData);

        // Handle main file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $collectionName = $validatedData['file_type'] === 'utama' ? 'dokumen_utama' : 'dokumen_lampiran';

            $dokumenHukum->addMedia($file->getRealPath())
                ->usingName($file->getClientOriginalName())
                ->usingFileName($validatedData['file_number'] . '_' . time() . '.' . $file->getClientOriginalExtension())
                ->withCustomProperties([
                    'file_number' => $validatedData['file_number'],
                    'file_type' => $validatedData['file_type']
                ])
                ->toMediaCollection($collectionName);
        }

        // Handle multiple attachments (hanya untuk file utama)
        if ($validatedData['file_type'] === 'utama' && $request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $dokumenHukum->addMedia($attachment->getRealPath())
                    ->usingName($attachment->getClientOriginalName())
                    ->usingFileName('ATTACH_' . $validatedData['file_number'] . '_' . time() . '_' . Str::random(4) . '.' . $attachment->getClientOriginalExtension())
                    ->withCustomProperties([
                        'file_number' => $validatedData['file_number'],
                        'file_type' => 'lampiran',
                        'is_attachment' => true
                    ])
                    ->toMediaCollection('dokumen_lampiran');
            }
        }

        return redirect()->route('dokumen-hukum.index')
<<<<<<< HEAD
            ->with('success', 'Dokumen hukum berhasil ditambahkan dengan nomor file: ' . $validatedData['file_number']);
=======
            ->with('success', 'Dokumen hukum berhasil ditambahkan!');
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
<<<<<<< HEAD
        $dataDokumenHukum = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen', 'mainFile', 'attachments'])
=======
        $dataDokumenHukum = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252
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
<<<<<<< HEAD
        $dataDokumenHukum = DokumenHukum::with(['mainFile', 'attachments'])->findOrFail($id);

=======
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252
        $data = [
            'dataDokumenHukum' => $dataDokumenHukum,
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
            'file_type' => 'required|in:utama,lampiran',
            'file_number' => 'nullable|max:50|unique:dokumen_hukum,file_number,' . $id . ',dokumen_id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

<<<<<<< HEAD
        // Jika file_number berubah, update semua media terkait
        if ($dokumenHukum->file_number !== $validatedData['file_number']) {
            // Update custom properties di media
            foreach ($dokumenHukum->media as $media) {
                $media->setCustomProperty('file_number', $validatedData['file_number']);
                $media->save();
            }
        }

=======
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252
        $dokumenHukum->update($validatedData);

        // Handle main file upload jika ada
        if ($request->hasFile('file')) {
            // Delete existing main file
            $collectionName = $validatedData['file_type'] === 'utama' ? 'dokumen_utama' : 'dokumen_lampiran';
            $dokumenHukum->clearMediaCollection($collectionName);

            // Upload new file
            $file = $request->file('file');
            $dokumenHukum->addMedia($file->getRealPath())
                ->usingName($file->getClientOriginalName())
                ->usingFileName($validatedData['file_number'] . '_' . time() . '.' . $file->getClientOriginalExtension())
                ->withCustomProperties([
                    'file_number' => $validatedData['file_number'],
                    'file_type' => $validatedData['file_type']
                ])
                ->toMediaCollection($collectionName);
        }

        // Handle attachments untuk file utama
        if ($validatedData['file_type'] === 'utama' && $request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $dokumenHukum->addMedia($attachment->getRealPath())
                    ->usingName($attachment->getClientOriginalName())
                    ->usingFileName('ATTACH_' . $validatedData['file_number'] . '_' . time() . '_' . Str::random(4) . '.' . $attachment->getClientOriginalExtension())
                    ->withCustomProperties([
                        'file_number' => $validatedData['file_number'],
                        'file_type' => 'lampiran',
                        'is_attachment' => true
                    ])
                    ->toMediaCollection('dokumen_lampiran');
            }
        }

        // Jika file_type berubah dari lampiran ke utama, hapus lampiran lama
        if ($dokumenHukum->getOriginal('file_type') === 'lampiran' && $validatedData['file_type'] === 'utama') {
            $dokumenHukum->clearMediaCollection('dokumen_lampiran');
        }

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokumenHukum = DokumenHukum::findOrFail($id);

        // Delete all associated media files
        $dokumenHukum->clearMediaCollection('dokumen_utama');
        $dokumenHukum->clearMediaCollection('dokumen_lampiran');

        $dokumenHukum->delete();

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil dihapus!');
    }
<<<<<<< HEAD

    /**
     * Download file by file_number
     */
    public function downloadByFileNumber(string $fileNumber)
    {
        $dokumenHukum = DokumenHukum::byFileNumber($fileNumber)->firstOrFail();

        $media = $dokumenHukum->mainFile ?? $dokumenHukum->media()->first();

        if (!$media) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($media->getPath(), $media->file_name);
    }

    /**
     * Search by file_number
     */
    public function searchByFileNumber(Request $request)
    {
        $request->validate([
            'file_number' => 'required|string'
        ]);

        $dokumenHukum = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen', 'mainFile', 'attachments'])
            ->byFileNumber($request->file_number)
            ->first();

        if (!$dokumenHukum) {
            return redirect()->back()
                ->with('error', 'Dokumen dengan nomor file ' . $request->file_number . ' tidak ditemukan.');
        }

        return view('pages.guest.dokumen_hukum.show', [
            'dataDokumenHukum' => $dokumenHukum
        ]);
    }
=======
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252
}
