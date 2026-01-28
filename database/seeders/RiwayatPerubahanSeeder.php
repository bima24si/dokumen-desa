<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatPerubahan;
use App\Models\User;
use Faker\Factory as Faker;

class RiwayatPerubahanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $userIds = User::pluck('id')->toArray(); // Pastikan User sudah ada

        $aksiList = ['Menambahkan', 'Mengubah', 'Menghapus', 'Memvalidasi', 'Mengunduh'];
        $objekList = ['Dokumen Hukum', 'Data Warga', 'Laporan Keuangan', 'Surat Keluar', 'Profil Desa'];

        for ($i = 0; $i < 100; $i++) {
            $aksi = $faker->randomElement($aksiList);
            $objek = $faker->randomElement($objekList);

            RiwayatPerubahan::create([
                'user_id' => !empty($userIds) ? $faker->randomElement($userIds) : null,
                'aksi' => $aksi,
                'entitas' => $objek,
                'keterangan' => "User telah berhasil " . strtolower($aksi) . " data pada " . strtolower($objek) . ".",
                'ip_address' => $faker->ipv4,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
