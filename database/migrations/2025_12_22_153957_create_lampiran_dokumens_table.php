<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lampiran_dokumens', function (Blueprint $table) {
            // Primary Key tabel ini
            $table->bigIncrements('lampiran_id'); // Atau $table->id(); terserah Anda

            // Foreign Key
            $table->unsignedBigInteger('dokumen_id');

            $table->foreign('dokumen_id')
                ->references('dokumen_id') // <--- KITA KEMBALIKAN KE 'dokumen_id'
                ->on('dokumen_hukum')
                ->cascadeOnDelete();

            // Data file
            $table->string('nama_file');
            $table->string('path_file');
            $table->string('tipe_file')->nullable();
            $table->integer('ukuran_file')->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();

            // Index
            $table->index('dokumen_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lampiran_dokumens');
    }
};
