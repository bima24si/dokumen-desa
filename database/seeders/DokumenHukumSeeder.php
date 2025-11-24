<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DokumenHukumSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID dari tabel referensi
        $jenisIds = DB::table('jenis_dokumen')->pluck('id')->toArray();
        $kategoriIds = DB::table('kategori_dokumen')->pluck('kategori_id')->toArray();

        if (empty($jenisIds) || empty($kategoriIds)) {
            echo "Seeder gagal: Pastikan tabel jenis_dokumen dan kategori_dokumen sudah terisi!\n";
            return;
        }

        for ($i = 1; $i <= 30; $i++) {
            DB::table('dokumen_hukum')->insert([
                'jenis_id' => $faker->randomElement($jenisIds),
                'kategori_id' => $faker->randomElement($kategoriIds),
                'nomor' => $faker->unique()->regexify('[A-Z]{2}/[0-9]{3}/[0-9]{4}'),
                'judul' => $faker->sentence(6),
                'tanggal' => $faker->date('Y-m-d'),
                'ringkasan' => $faker->paragraph(3),
                'status' => $faker->randomElement(['aktif', 'tidak_aktif']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
