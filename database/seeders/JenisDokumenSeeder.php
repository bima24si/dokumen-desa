<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class JenisDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Data utama (wajib ada dan unik)
        $jenis_dokumen = [
            'Peraturan Desa (Perdes)',
            'Peraturan Kepala Desa (Perkades)',
            'Surat Edaran (SE)',
            'Keputusan Kepala Desa',
            'Peraturan Bersama Kepala Desa',
            'Surat Keputusan',
            'Surat Perintah',
            'Surat Tugas',
            'Nota Dinas',
            'Berita Acara',
        ];

        foreach ($jenis_dokumen as $nama) {
            DB::table('jenis_dokumen')->insert([
                'nama_jenis' => $nama,
                'deskripsi' => $faker->sentence(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Data dummy tambahan hingga 100 data
        $existing_count = count($jenis_dokumen);
        $needed_count = 100 - $existing_count;

        $jenis_prefixes = [
            'Dokumen', 'Surat', 'Formulir', 'Laporan', 'Berkas', 'Arsip',
            'File', 'Data', 'Informasi', 'Catatan'
        ];

        $jenis_suffixes = [
            'Resmi', 'Internal', 'Eksternal', 'Rahasia', 'Biasa', 'Pentings',
            'Sementara', 'Permanen', 'Digital', 'Fisik'
        ];

        for ($i = 1; $i <= $needed_count; $i++) {
            $prefix = $faker->randomElement($jenis_prefixes);
            $suffix = $faker->randomElement($jenis_suffixes);
            $nama_jenis = $prefix . ' ' . $suffix . ' ' . $faker->unique()->numberBetween(1, 1000);

            DB::table('jenis_dokumen')->insert([
                'nama_jenis' => $nama_jenis,
                'deskripsi' => $faker->sentence(10),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
