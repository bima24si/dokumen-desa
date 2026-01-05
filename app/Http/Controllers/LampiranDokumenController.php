<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\LampiranDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LampiranDokumenController extends Controller
{
    public function index(Request $request)
    {
        $query = LampiranDokumen::with('dokumen')
            ->latest()
            ->filter(request(['search', 'dokumen_id', 'tipe_file']));

        $dokumenList  = DokumenHukum::orderBy('judul')->get();
        $tipeFileList = LampiranDokumen::select('tipe_file')->distinct()->pluck('tipe_file');

        $totalLampiran = $query->count();
        $totalUkuran   = $query->sum('ukuran_file');
        $lampiran      = $query->paginate(20)->withQueryString();

        return view('pages.guest.lampiran_dokumen.index', compact(
            'lampiran', 'dokumenList', 'tipeFileList', 'totalLampiran', 'totalUkuran'
        ));
    }

    public function create()
    {
        $dokumenList = DokumenHukum::orderBy('judul')->get();
        return view('pages.guest.lampiran_dokumen.create', compact('dokumenList'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            // PERBAIKAN UTAMA DI SINI:
            // Ubah 'exists:dokumen_hukum,id' menjadi 'exists:dokumen_hukum,dokumen_id'
            'dokumen_id' => 'required|exists:dokumen_hukum,dokumen_id',
            'file'       => 'required|file|max:10240', // Max 10MB
            'keterangan' => 'nullable|string|max:500',
        ], [
            'dokumen_id.required' => 'Wajib memilih Dokumen Induk.',
            'dokumen_id.exists'   => 'Dokumen Induk tidak valid (ID tidak ditemukan).',
            'file.required'       => 'Wajib mengupload file.',
            'file.max'            => 'Ukuran file maksimal 10MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // 2. Proses Upload File
            $file         = $request->file('file');
            $originalName = $file->getClientOriginalName();

            // Nama file unik
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $originalName);

            // Simpan ke 'storage/app/public/lampiran'
            $filePath = $file->storeAs('lampiran', $fileName, 'public');

            // 3. Simpan ke Database
            LampiranDokumen::create([
                'dokumen_id'  => $request->dokumen_id,
                'nama_file'   => $originalName,
                'path_file'   => $filePath,
                'tipe_file'   => $file->getClientMimeType(),
                'ukuran_file' => $file->getSize(),
                'keterangan'  => $request->keterangan,
            ]);

            return redirect()->route('lampiran-dokumen.index')
                ->with('success', 'Lampiran berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Hapus file jika database gagal
            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function edit(LampiranDokumen $lampiranDokumen)
    {
        $dokumenList = DokumenHukum::orderBy('judul')->get();
        return view('pages.guest.lampiran_dokumen.edit', compact('lampiranDokumen', 'dokumenList'));
    }

    public function update(Request $request, LampiranDokumen $lampiranDokumen)
    {
        $validator = Validator::make($request->all(), [
            // PERBAIKAN DI SINI JUGA:
            'dokumen_id' => 'required|exists:dokumen_hukum,dokumen_id',
            'file'       => 'nullable|file|max:10240',
            'keterangan' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'dokumen_id' => $request->dokumen_id,
                'keterangan' => $request->keterangan,
            ];

            if ($request->hasFile('file')) {
                // Hapus file lama (Gunakan disk public)
                if ($lampiranDokumen->path_file && Storage::disk('public')->exists($lampiranDokumen->path_file)) {
                    Storage::disk('public')->delete($lampiranDokumen->path_file);
                }

                $file     = $request->file('file');
                $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $filePath = $file->storeAs('lampiran', $fileName, 'public');

                $data = array_merge($data, [
                    'nama_file'   => $file->getClientOriginalName(),
                    'path_file'   => $filePath,
                    'tipe_file'   => $file->getClientMimeType(),
                    'ukuran_file' => $file->getSize(),
                ]);
            }

            $lampiranDokumen->update($data);
            return redirect()->route('lampiran-dokumen.index')->with('success', 'Berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function destroy(LampiranDokumen $lampiranDokumen)
    {
        if ($lampiranDokumen->path_file && Storage::disk('public')->exists($lampiranDokumen->path_file)) {
            Storage::disk('public')->delete($lampiranDokumen->path_file);
        }

        $lampiranDokumen->delete();
        return redirect()->route('lampiran-dokumen.index')->with('success', 'Berhasil dihapus');
    }

    // Fungsi Download Lampiran
    public function download($id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);

        if ($lampiran->path_file && Storage::disk('public')->exists($lampiran->path_file)) {
            return Storage::disk('public')->download($lampiran->path_file, $lampiran->nama_file);
        }

        return back()->with('error', 'File fisik tidak ditemukan di server.');
    }
}
