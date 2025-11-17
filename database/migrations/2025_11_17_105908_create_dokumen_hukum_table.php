<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumen_hukum', function (Blueprint $table) {
            $table->id('dokumen_id'); // Primary key auto increment
            $table->unsignedBigInteger('jenis_id');
            $table->unsignedBigInteger('kategori_id');
            $table->string('nomor')->unique();
            $table->string('judul');
            $table->date('tanggal');
            $table->text('ringkasan')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('jenis_id')->references('id')->on('jenis_dokumen')->onDelete('cascade');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori_dokumen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_hukum');
    }
};
