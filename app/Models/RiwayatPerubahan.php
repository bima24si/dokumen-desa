<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPerubahan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_perubahans';

    protected $fillable = [
        'user_id',
        'aksi',
        'entitas',
        'keterangan',
        'ip_address',
    ];

    // Relasi: Setiap riwayat dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
