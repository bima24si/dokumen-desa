<?php
// [file name]: DokumenHukum.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status'
    ];

    /**
     * Get the jenis dokumen that owns the dokumen hukum.
     */
    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_id', 'jenis_id');
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
}
