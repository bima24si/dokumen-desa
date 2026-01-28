<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// Pastikan Model mengimplementasikan HasMedia
class DokumenHukum extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'dokumen_hukum';
    protected $primaryKey = 'dokumen_id'; // Sesuai migration Anda

    protected $fillable = [
        'jenis_id',
        'kategori_id',
        'nomor',
        'judul',
        'tanggal',
        'ringkasan',
        'status',
        'file_number',
        'file_type',
    ];

    // Relasi ke Jenis Dokumen
    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_id');
    }

    // Relasi ke Kategori Dokumen
    public function kategoriDokumen()
    {
        // Sesuaikan foreign key dengan migration (kategori_id)
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id', 'kategori_id');
    }

    // Helper untuk mengambil file utama (PDF/Doc)
    public function getMainFileAttribute()
    {
        return $this->getMedia('dokumen_utama')->last();
    }

    // Helper untuk mengambil lampiran
    public function getAttachmentsAttribute()
    {
        return $this->getMedia('dokumen_lampiran');
    }

    // Scope pencarian (agar controller lebih rapi)
    public function scopeFilter($query, $request, $columns)
    {
        foreach ($columns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->$column);
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, $columns)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }
        return $query;
    }

    public function scopeDateRange($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('tanggal', [$startDate, $endDate]);
        }
        return $query;
    }

    // Scope pencarian by file number
    public function scopeByFileNumber($query, $fileNumber)
    {
        return $query->where('file_number', $fileNumber);
    }

    /**
     * Fungsi Generate Nomor File Otomatis
     * Dipanggil oleh Controller saat create()
     */
    public static function generateFileNumber($type = 'utama')
    {
        // Format: DOC-YYYYMMDD-XXXX (Urutan)
        $prefix = 'DOC-' . date('Ymd') . '-';

        // Cari nomor terakhir hari ini
        $lastRecord = self::where('file_number', 'like', $prefix . '%')
                          ->orderBy('file_number', 'desc')
                          ->first();

        if ($lastRecord) {
            // Ambil 4 digit terakhir
            $lastNumber = intval(substr($lastRecord->file_number, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Pad dengan 0 (misal: 0001)
        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
