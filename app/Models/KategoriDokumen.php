<?php
<<<<<<< HEAD


=======
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

use Illuminate\Database\Eloquent\Builder;


=======
use Illuminate\Database\Eloquent\Builder;
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252

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
<<<<<<< HEAD

=======
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252

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
<<<<<<< HEAD


=======
>>>>>>> 5e34c6d034decb4a938d3b0ed9310ed366b93252
}
