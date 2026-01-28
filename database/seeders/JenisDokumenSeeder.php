<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class JenisDokumenSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // 10 Data Utama Statis
        $jenis_utama = [
            'Peraturan Desa', 'Peraturan Kepala Desa', 'Surat Edaran',
            'Keputusan Kepala Desa', 'Berita Acara', 'Surat Tugas',
            'Nota Dinas', 'Surat Keputusan', 'Surat Perintah', 'Peraturan Bersama'
        ];

        foreach ($jenis_utama as $nama) {
            DB::table('jenis_dokumen')->updateOrInsert(
                ['nama_jenis' => $nama],
                [
                    'deskripsi' => 'Dokumen resmi administrasi desa.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Sisa 90 Data Tambahan
        $sifat = ['Umum', 'Rahasia', 'Internal', 'Publik', 'Khusus', 'Terbatas', 'Prioritas', 'Arsip'];
        $bidang = ['Keuangan', 'Pembangunan', 'Kepegawaian', 'Aset', 'Pelayanan'];

        for ($i = 11; $i <= 100; $i++) {
            $namaJenis = 'Dokumen ' . $faker->randomElement($sifat) . ' ' . $faker->randomElement($bidang) . ' ' . $i;

            DB::table('jenis_dokumen')->insert([
                'nama_jenis' => $namaJenis,
                'deskripsi' => 'Kategori dokumen pendukung untuk keperluan ' . strtolower($namaJenis) . '.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
