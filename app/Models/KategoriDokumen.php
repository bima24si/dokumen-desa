<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;



class KategoriDokumen extends Model
{
    use HasFactory;

    protected $table = 'kategori_dokumen';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    /**
     * Get the dokumen hukum for the kategori.
     */
    public function dokumenHukum()
    {
        return $this->hasMany(DokumenHukum::class, 'kategori_id', 'kategori_id');
    }

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }


}
