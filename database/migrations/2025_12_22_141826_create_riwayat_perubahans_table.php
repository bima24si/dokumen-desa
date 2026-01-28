<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_perubahans', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users (penanggung jawab aksi)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('aksi'); // Contoh: Tambah, Ubah, Hapus, Login
            $table->string('entitas')->nullable(); // Contoh: Surat Pengantar, Data Warga
            $table->text('keterangan'); // Detail perubahan
            $table->string('ip_address', 45)->nullable(); // Menyimpan IP V4/V6
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_perubahans');
    }
};
