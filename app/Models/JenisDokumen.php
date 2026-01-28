<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 1. IMPORT YANG BENAR: Gunakan DokumenHukum, bukan Dokumen
use App\Models\DokumenHukum;

class JenisDokumen extends Model
{
    use HasFactory;

    protected $table = 'jenis_dokumen';

    protected $fillable = ['nama_jenis', 'deskripsi'];

    // 2. PERBAIKI RELASI
    // Kita tetap namakan fungsinya 'dokumens' agar tidak perlu ubah Controller/View
    public function dokumens()
    {
        // Hubungkan ke Model DokumenHukum
        // Pastikan tabel 'dokumen_hukum' punya kolom 'jenis_id'
        return $this->hasMany(DokumenHukum::class, 'jenis_id', 'id');
    }

    // 3. SCOPE FILTER (Untuk memperbaiki error 'undefined method filter')
    public function scopeFilter(Builder $query, $request, array $filters)
    {
        foreach ($filters as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, 'LIKE', '%' . $request->$filter . '%');
            }
        }
        return $query;
    }

    // 4. SCOPE SEARCH (Untuk fitur pencarian)
    public function scopeSearch(Builder $query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                $searchTerm = '%' . $request->search . '%';
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $searchTerm);
                }
            });
        }
        return $query;
    }
}
