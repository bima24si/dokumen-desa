<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class KategoriDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Data kategori umum (tetap dipertahankan)
        $kategori_dokumen = [
            'Pemerintahan Desa',
            'Pembangunan Desa',
            'Pembinaan Kemasyarakatan',
            'Pemberdayaan Masyarakat',
            'Keuangan Desa',
            'Administrasi Desa',
            'Perencanaan Desa',
            'Pelayanan Masyarakat',
            'Badan Permusyawaratan Desa',
            'Lembaga Kemasyarakatan',
        ];

        foreach ($kategori_dokumen as $nama) {
            DB::table('kategori_dokumen')->insert([
                'nama' => $nama,
                'deskripsi' => $faker->sentence(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Data dummy tambahan hingga 100 data
        $existing_count = count($kategori_dokumen);
        $needed_count = 100 - $existing_count;

        $kategori_names = [
            'Kategori', 'Bidang', 'Jenis', 'Kelompok', 'Golongan', 'Klasifikasi',
            'Kumpulan', 'Seri', 'Bagian', 'Divisi'
        ];

        for ($i = 1; $i <= $needed_count; $i++) {
            $prefix = $faker->randomElement($kategori_names);
            $nama_kategori = $prefix . ' ' . $faker->unique()->words($faker->numberBetween(1, 3), true);

            DB::table('kategori_dokumen')->insert([
                'nama' => $nama_kategori,
                'deskripsi' => $faker->sentence(10),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
