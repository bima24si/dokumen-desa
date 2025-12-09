<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class DokumenHukum extends Model
{
    use HasFactory;

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
        'file_number', // Tambahkan ini
        'file_type'   // Tambahkan ini
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

    /**
     * Scope untuk mencari berdasarkan file_number
     */
    public function scopeByFileNumber(Builder $query, string $fileNumber): Builder
    {
        return $query->where('file_number', $fileNumber);
    }

    /**
     * Scope untuk filter berdasarkan file_type
     */
    public function scopeFileType(Builder $query, string $type): Builder
    {
        return $query->where('file_type', $type);
    }

    /**
     * Get the jenis dokumen that owns the dokumen hukum.
     */
    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_id', 'id');
    }

    /**
     * Get the kategori dokumen that owns the dokumen hukum.
     */
    public function kategoriDokumen()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id', 'kategori_id');
    }

    /**
     * Get the media for the dokumen hukum.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    /**
     * Get the main file media (file utama)
     */
    public function mainFile()
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', 'dokumen_utama');
    }

    /**
     * Get the attachment files (lampiran)
     */
    public function attachments()
    {
        return $this->morphMany(Media::class, 'model')
            ->where('collection_name', 'dokumen_lampiran');
    }

    /**
     * Scope untuk filter data
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    /**
     * Scope untuk search data
     */
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

    /**
     * Scope untuk date range filter
     */
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
}
