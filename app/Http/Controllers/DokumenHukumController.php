<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule; // PENTING: Untuk validasi unique yang benar
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DokumenHukumController extends Controller
{
    /**
     * Menampilkan daftar dokumen (Index)
     */
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_id', 'kategori_id', 'status', 'file_type'];
        $searchableColumns = ['nomor', 'judul', 'ringkasan', 'file_number'];

        $query = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns);

        // Filter Tanggal
        if ($request->filled(['start_date', 'end_date'])) {
             $query->dateRange($request->start_date, $request->end_date);
        }

        // Sorting Logic
        $sortOrder = match ($request->sort) {
            'judul_asc'        => ['judul', 'asc'],
            'judul_desc'       => ['judul', 'desc'],
            'tanggal_terbaru'  => ['tanggal', 'desc'],
            'tanggal_terlama'  => ['tanggal', 'asc'],
            'nomor_asc'        => ['nomor', 'asc'],
            'nomor_desc'       => ['nomor', 'desc'],
            'file_number_asc'  => ['file_number', 'asc'],
            'file_number_desc' => ['file_number', 'desc'],
            'terlama'          => ['created_at', 'asc'],
            default            => ['created_at', 'desc'] // Default terbaru
        };

        $query->orderBy($sortOrder[0], $sortOrder[1]);
        $dataDokumenHukum = $query->paginate(12)->withQueryString();

        // Data Statistik untuk View
        $data = [
            'dataDokumenHukum'    => $dataDokumenHukum,
            'dataJenisDokumen'    => JenisDokumen::all(),
            'dataKategoriDokumen' => KategoriDokumen::all(),
            'totalDokumen'        => DokumenHukum::count(),
            'dokumenAktif'        => DokumenHukum::where('status', 'aktif')->count(),
            'dokumenTidakAktif'   => DokumenHukum::where('status', 'tidak_aktif')->count(),
            // Menggunakan scope/where standar
            'dokumenUtama'        => DokumenHukum::where('file_type', 'utama')->count(),
            'dokumenLampiran'     => DokumenHukum::where('file_type', 'lampiran')->count(),
        ];

        return view('pages.guest.dokumen_hukum.index', $data);
    }

    /**
     * Form Tambah Dokumen (Create)
     */
    public function create()
    {
        $data = [
            'dataJenisDokumen'    => JenisDokumen::all(),
            'dataKategoriDokumen' => KategoriDokumen::all(),
            // Generate nomor default saat form dibuka (opsional, bisa juga generate saat store)
            'fileNumber'          => DokumenHukum::generateFileNumber('utama'),
        ];

        return view('pages.guest.dokumen_hukum.create', $data);
    }

    /**
     * Simpan Dokumen Baru (Store)
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $validatedData = $request->validate([
            'jenis_id'      => 'required|exists:jenis_dokumen,id',
            'kategori_id'   => 'required|exists:kategori_dokumen,kategori_id',
            // Perbaikan Validasi Unique:
            'nomor'         => ['required', 'max:255', Rule::unique('dokumen_hukum', 'nomor')],
            'judul'         => 'required|max:255',
            'tanggal'       => 'required|date',
            'ringkasan'     => 'nullable|string',
            'status'        => 'required|in:aktif,tidak_aktif',
            'file_type'     => 'required|in:utama,lampiran',
            'file_number'   => ['nullable', 'max:50', Rule::unique('dokumen_hukum', 'file_number')],
            'file'          => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // Max 10MB
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        // 2. Generate File Number jika kosong
        if (empty($validatedData['file_number'])) {
            $validatedData['file_number'] = DokumenHukum::generateFileNumber($validatedData['file_type']);
        }

        // 3. Simpan Data Dokumen
        $dokumenHukum = DokumenHukum::create($validatedData);

        // 4. Upload File Utama
        if ($request->hasFile('file')) {
            $collectionName = $validatedData['file_type'] === 'utama' ? 'dokumen_utama' : 'dokumen_lampiran';
            $file = $request->file('file');

            $dokumenHukum->addMedia($file)
                ->usingName($file->getClientOriginalName()) // Nama asli file
                ->usingFileName($validatedData['file_number'] . '_' . time() . '.' . $file->getClientOriginalExtension())
                ->withCustomProperties([
                    'file_number' => $validatedData['file_number'],
                    'file_type'   => $validatedData['file_type'],
                ])
                ->toMediaCollection($collectionName);
        }

        // 5. Upload Lampiran (Multiple)
        if ($validatedData['file_type'] === 'utama' && $request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $dokumenHukum->addMedia($attachment)
                    ->usingName($attachment->getClientOriginalName())
                    ->usingFileName('ATTACH_' . $validatedData['file_number'] . '_' . time() . '_' . Str::random(4) . '.' . $attachment->getClientOriginalExtension())
                    ->withCustomProperties([
                        'file_number'   => $validatedData['file_number'],
                        'file_type'     => 'lampiran',
                        'is_attachment' => true,
                    ])
                    ->toMediaCollection('dokumen_lampiran');
            }
        }

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen berhasil ditambahkan. Nomor File: ' . $validatedData['file_number']);
    }

    /**
     * Detail Dokumen (Show)
     */
    public function show(string $id)
    {
        // Menggunakan 'media' untuk memuat semua file terkait
        $dataDokumenHukum = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen', 'media'])
            ->findOrFail($id);

        return view('pages.guest.dokumen_hukum.show', [
            'dataDokumenHukum' => $dataDokumenHukum,
        ]);
    }

    /**
     * Form Edit (Edit)
     */
    public function edit(string $id)
    {
        $dataDokumenHukum = DokumenHukum::with(['media'])->findOrFail($id);

        $data = [
            'dataDokumenHukum'    => $dataDokumenHukum,
            'dataJenisDokumen'    => JenisDokumen::all(),
            'dataKategoriDokumen' => KategoriDokumen::all(),
        ];

        return view('pages.guest.dokumen_hukum.edit', $data);
    }

    /**
     * Update Dokumen (Update)
     */
    public function update(Request $request, string $id)
    {
        $dokumenHukum = DokumenHukum::findOrFail($id);

        // 1. Validasi Update (FIX UTAMA: Ignore ID Custom)
        // Kita menggunakan 'dokumen_id' karena itu adalah Primary Key di database Anda.
        $validatedData = $request->validate([
            'jenis_id'      => 'required|exists:jenis_dokumen,id',
            'kategori_id'   => 'required|exists:kategori_dokumen,kategori_id',
            'nomor'         => [
                'required',
                'max:255',
                Rule::unique('dokumen_hukum', 'nomor')->ignore($id, 'dokumen_id') // Fix Error 42S22
            ],
            'judul'         => 'required|max:255',
            'tanggal'       => 'required|date',
            'ringkasan'     => 'nullable|string',
            'status'        => 'required|in:aktif,tidak_aktif',
            'file_type'     => 'required|in:utama,lampiran',
            'file_number'   => [
                'nullable',
                'max:50',
                Rule::unique('dokumen_hukum', 'file_number')->ignore($id, 'dokumen_id') // Fix Error 42S22
            ],
            'file'          => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        // 2. Update Properti Media jika File Number berubah
        // Ini menjaga konsistensi data di tabel media
        if ($dokumenHukum->file_number !== $validatedData['file_number'] && !empty($validatedData['file_number'])) {
            foreach ($dokumenHukum->media as $media) {
                $media->setCustomProperty('file_number', $validatedData['file_number']);
                $media->save();
            }
        }

        // 3. Update Data Utama
        $dokumenHukum->update($validatedData);

        // 4. Handle File Utama (Replace)
        if ($request->hasFile('file')) {
            $collectionName = $validatedData['file_type'] === 'utama' ? 'dokumen_utama' : 'dokumen_lampiran';

            // Bersihkan file lama di koleksi ini
            $dokumenHukum->clearMediaCollection($collectionName);

            $file = $request->file('file');
            $dokumenHukum->addMedia($file)
                ->usingName($file->getClientOriginalName())
                ->usingFileName($validatedData['file_number'] . '_' . time() . '.' . $file->getClientOriginalExtension())
                ->withCustomProperties([
                    'file_number' => $validatedData['file_number'],
                    'file_type'   => $validatedData['file_type'],
                ])
                ->toMediaCollection($collectionName);
        }

        // 5. Handle Lampiran (Append/Tambah Baru)
        if ($validatedData['file_type'] === 'utama' && $request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $dokumenHukum->addMedia($attachment)
                    ->usingName($attachment->getClientOriginalName())
                    ->usingFileName('ATTACH_' . $validatedData['file_number'] . '_' . time() . '_' . Str::random(4) . '.' . $attachment->getClientOriginalExtension())
                    ->withCustomProperties([
                        'file_number'   => $validatedData['file_number'],
                        'file_type'     => 'lampiran',
                        'is_attachment' => true,
                    ])
                    ->toMediaCollection('dokumen_lampiran');
            }
        }

        // 6. Bersihkan lampiran jika tipe dokumen diubah menjadi lampiran
        // (Logika: Lampiran tidak boleh punya lampiran lain)
        if ($dokumenHukum->getOriginal('file_type') === 'utama' && $validatedData['file_type'] === 'lampiran') {
            $dokumenHukum->clearMediaCollection('dokumen_lampiran');
        }

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil diperbarui!');
    }

    /**
     * Hapus Dokumen
     */
    public function destroy(string $id)
    {
        $dokumenHukum = DokumenHukum::findOrFail($id);

        // Spatie otomatis menghapus file fisik saat model dihapus
        $dokumenHukum->delete();

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil dihapus!');
    }

    /**
     * CUSTOM: Download File
     * Route: /dokumen-hukum/download/{file_number}
     */
    public function download(string $fileNumber)
    {
        // Cari dokumen berdasarkan file_number
        $dokumenHukum = DokumenHukum::where('file_number', $fileNumber)->firstOrFail();

        // Cari file media
        // Cek dokumen utama dulu
        $media = $dokumenHukum->getFirstMedia('dokumen_utama');

        // Jika tidak ada, cek lampiran
        if (! $media) {
             $media = $dokumenHukum->getFirstMedia('dokumen_lampiran');
        }

        // Validasi fisik file
        if (! $media || ! file_exists($media->getPath())) {
            return back()->with('error', 'File fisik tidak ditemukan di server.');
        }

        return response()->download($media->getPath(), $media->file_name);
    }

    /**
     * CUSTOM: Download Lampiran Spesifik
     * Jika Anda ingin mendownload lampiran tertentu berdasarkan ID Media
     */
    public function downloadAttachment($id)
    {
        // Cari media berdasarkan ID (Tabel media)
        $media = Media::findOrFail($id);

        if (! file_exists($media->getPath())) {
            return back()->with('error', 'File lampiran tidak ditemukan.');
        }

        return response()->download($media->getPath(), $media->file_name);
    }
}
