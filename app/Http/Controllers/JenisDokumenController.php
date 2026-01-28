<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;

class JenisDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Data untuk dropdown filter (opsional, jika dipakai di view)
        $data['allJenis'] = JenisDokumen::select('nama_jenis')->distinct()->get();

        // 1. Kolom yang bisa di-filter (misal: ?nama_jenis=Surat)
        $filterableColumns = ['nama_jenis'];

        // 2. Kolom yang bisa dicari via search box global
        $searchableColumns = ['nama_jenis', 'deskripsi'];

        // Mulai Query
        $query = JenisDokumen::query();

        // Apply filter (Memanggil scopeFilter di Model)
        $query->filter($request, $filterableColumns);

        // Apply search (Memanggil scopeSearch di Model)
        $query->search($request, $searchableColumns);

        // Get paginated results
        $data['dataJenisDokumen'] = $query->paginate(12)->withQueryString();

        return view('pages.guest.dokumen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.guest.dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jenis' => 'required|unique:jenis_dokumen,nama_jenis|max:255',
            'deskripsi'  => 'nullable|string',
        ]);

        JenisDokumen::create($validatedData);

        return redirect()->route('dokumen.index')
            ->with('success', 'Jenis dokumen berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function show(string $id)
    {
        // Mengambil data jenis dokumen beserta relasi dokumennya (jika ada)
        // 'dokumens' diambil dari nama fungsi relasi di Model JenisDokumen
        $jenisDokumen = JenisDokumen::with('dokumens')->findOrFail($id);

        return view('pages.guest.dokumen.show', compact('jenisDokumen'));
    }

    public function edit(string $id)
    {
        $data['dataJenisDokumen'] = JenisDokumen::findOrFail($id);
        return view('pages.guest.dokumen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenisDokumen = JenisDokumen::findOrFail($id);

        $validatedData = $request->validate([
            // Validasi unique mengecualikan ID saat ini agar tidak error jika nama tidak diganti
            'nama_jenis' => 'required|max:255|unique:jenis_dokumen,nama_jenis,' . $id,
            'deskripsi'  => 'nullable|string',
        ]);

        $jenisDokumen->update($validatedData);

        return redirect()->route('dokumen.index')
            ->with('success', 'Jenis dokumen berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisDokumen = JenisDokumen::findOrFail($id);
        $jenisDokumen->delete();

        return redirect()->route('dokumen.index')
            ->with('success', 'Jenis dokumen berhasil dihapus!');
    }
}
