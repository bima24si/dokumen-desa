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
        // Data untuk dropdown filter
        $data['allJenis'] = JenisDokumen::select('nama_jenis')->distinct()->get();

        // Kolom yang bisa di-filter
        $filterableColumns = ['nama_jenis'];

        // Kolom yang bisa dicari
        $searchableColumns = ['nama_jenis', 'deskripsi'];

        // Query dengan filter dan search
        $query = JenisDokumen::query();

        // Apply filter
        $query->filter($request, $filterableColumns);

        // Apply search
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
        $data = $request->validate([
            'nama_jenis' => 'required|unique:jenis_dokumen|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        JenisDokumen::create($data);

        return redirect()->route('dokumen.index')->with('success', 'Jenis dokumen berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
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

        $data = $request->validate([
            'nama_jenis' => 'required|max:255|unique:jenis_dokumen,nama_jenis,' . $id,
            'deskripsi' => 'nullable|string',
        ]);

        $jenisDokumen->update($data);

        return redirect()->route('dokumen.index')->with('success', 'Jenis dokumen berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisDokumen = JenisDokumen::findOrFail($id);
        $jenisDokumen->delete();

        return redirect()->route('dokumen.index')->with('success', 'Jenis dokumen berhasil dihapus!');
    }
}
