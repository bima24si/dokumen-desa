<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['nama', 'no_ktp', 'pekerjaan', 'telp', 'email'];

        $data['dataWarga'] = Warga::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(12)
            ->withQueryString();

        return view('pages.guest.warga.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.guest.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'no_ktp' => 'required|unique:warga|max:20',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|max:20',
            'pekerjaan' => 'required|max:50',
            'telp' => 'required|max:15',
            'email' => 'required|email|max:100',
        ]);

        Warga::create($data);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * Display the specified resource. (INI YANG BARU KITA TAMBAHKAN)
     */
    public function show(string $id)
    {
        // Mengambil data berdasarkan ID, jika tidak ada akan error 404
        $warga = Warga::findOrFail($id);

        // Mengirim data ke view show
        return view('pages.guest.warga.show', compact('warga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataWarga'] = Warga::findOrFail($id);
        return view('pages.guest.warga.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warga = Warga::findOrFail($id);

        $data = $request->validate([
            'no_ktp' => 'required|max:20|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|max:20',
            'pekerjaan' => 'required|max:50',
            'telp' => 'required|max:15',
            'email' => 'required|email|max:100',
        ]);

        $warga->update($data);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}   
