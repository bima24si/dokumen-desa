<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class KategoriDokumenSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Data Utama
        $kategori_utama = [
            'Pemerintahan', 'Pembangunan', 'Kemasyarakatan',
            'Pemberdayaan', 'Keuangan', 'Aset Desa',
            'Pelayanan', 'Umum', 'Perencanaan', 'Hukum'
        ];

        foreach ($kategori_utama as $nama) {
            DB::table('kategori_dokumen')->updateOrInsert(
                ['nama' => $nama],
                [
                    'deskripsi' => 'Arsip bidang ' . strtolower($nama) . '.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Data Tambahan
        $sub = ['Logistik', 'Humas', 'Inventaris', 'Kearsipan', 'Pemuda', 'Olahraga', 'Kesenian', 'Pertanian'];

        for ($i = 11; $i <= 100; $i++) {
            $namaKategori = 'Sub-Bidang ' . $faker->randomElement($sub) . ' ' . ($i);

            DB::table('kategori_dokumen')->insert([
                'nama' => $namaKategori,
                'deskripsi' => 'Pengelompokan arsip khusus urusan ' . strtolower($namaKategori) . '.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
