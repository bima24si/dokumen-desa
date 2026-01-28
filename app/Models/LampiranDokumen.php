<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DokumenHukum;

class LampiranDokumen extends Model
{
    use HasFactory;

    protected $table = 'lampiran_dokumens';

    // Primary Key tabel ini
    protected $primaryKey = 'lampiran_id';

    protected $fillable = [
        'dokumen_id',
        'nama_file',
        'path_file',
        'tipe_file',
        'ukuran_file',
        'keterangan'
    ];

    /**
     * Relasi ke Dokumen Hukum
     * PERBAIKAN: Parameter ke-3 harus 'dokumen_id', BUKAN 'id'
     */
    public function dokumen()
    {
        return $this->belongsTo(
            DokumenHukum::class,
            'dokumen_id', // Foreign Key di tabel lampiran_dokumens
            'dokumen_id'  // Owner Key (PK) di tabel dokumen_hukum <-- INI YANG TADI SALAH
        );
    }

    // Scope Filter (Membersihkan Controller)
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('nama_file', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['dokumen_id'] ?? false, function($query, $dokumenId) {
            return $query->where('dokumen_id', $dokumenId);
        });

        $query->when($filters['tipe_file'] ?? false, function($query, $tipe) {
            return $query->where('tipe_file', $tipe);
        });
    }

    // Accessor Icon
    public function getFileIconAttribute()
    {
        $mime = $this->tipe_file ?? ''; // Tambah null coalesce operator biar aman
        if (str_contains($mime, 'pdf')) return 'fas fa-file-pdf text-danger';
        if (str_contains($mime, 'word')) return 'fas fa-file-word text-primary';
        if (str_contains($mime, 'excel') || str_contains($mime, 'spreadsheet')) return 'fas fa-file-excel text-success';
        if (str_contains($mime, 'image')) return 'fas fa-file-image text-warning';
        return 'fas fa-file text-secondary';
    }

    // Accessor Format Ukuran
    public function getUkuranFileFormattedAttribute()
    {
        $bytes = $this->ukuran_file;
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' bytes';
    }
}
