<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
// 1. Import Class Penting dari Spatie
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

// 2. Tambahkan "implements HasMedia"
class DokumenHukum extends Model implements HasMedia
{
    // 3. Tambahkan Trait "InteractsWithMedia"
    use HasFactory, InteractsWithMedia;

    protected $table = 'dokumen_hukum';
    protected $primaryKey = 'dokumen_id';

    protected $fillable = [
        'jenis_id',
        'kategori_id',
        'nomor',
        'judul',
        'tanggal',
        'ringkasan',
        'status',
        'file_number',
        'file_type'
    ];

    /**
     * Generate nomor unik untuk file/lampiran
     */
    public static function generateFileNumber(string $type = 'utama'): string
    {
        $prefix = match($type) {
            'utama' => 'FILE',
            'lampiran' => 'LAMP',
            default => 'DOC'
        };

        do {
            $number = $prefix . '/' . date('Y') . '/' . Str::random(6);
        } while (self::where('file_number', $number)->exists());

        return $number;
    }

    /* SCOPES */
    public function scopeByFileNumber(Builder $query, string $fileNumber): Builder
    {
        return $query->where('file_number', $fileNumber);
    }

    public function scopeFileType(Builder $query, string $type): Builder
    {
        return $query->where('file_type', $type);
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

    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }

    public function scopeDateRange(Builder $query, ?string $startDate, ?string $endDate): Builder
    {
        return $query->when($startDate && $endDate,
            fn($q) => $q->whereBetween('tanggal', [$startDate, $endDate])
        )->when($startDate && !$endDate,
            fn($q) => $q->where('tanggal', '>=', $startDate)
        )->when($endDate && !$startDate,
            fn($q) => $q->where('tanggal', '<=', $endDate)
        );
    }

    /* RELATIONS */
    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_id', 'id');
    }

    public function kategoriDokumen()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id', 'kategori_id');
    }

    // CATATAN PENTING:
    // Fungsi public function media() SAYA HAPUS.
    // Karena Trait "InteractsWithMedia" sudah menyediakannya secara otomatis.
    // Jika tidak dihapus, akan terjadi error konflik/tabrakan.

    /**
     * Relasi helper untuk mengambil file utama (menggunakan class Media dari Spatie)
     */
    public function mainFile()
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', 'dokumen_utama');
    }

    /**
     * Relasi helper untuk mengambil lampiran
     */
    public function attachments()
    {
        return $this->morphMany(Media::class, 'model')
            ->where('collection_name', 'dokumen_lampiran');
    }
}
