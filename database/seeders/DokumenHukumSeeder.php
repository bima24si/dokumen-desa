<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\DokumenHukum;

class DokumenHukumSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Pastikan tabel referensi ada isinya
        $jenisIds = DB::table('jenis_dokumen')->pluck('id')->toArray();
        $kategoriIds = DB::table('kategori_dokumen')->pluck('kategori_id')->toArray();

        if (empty($jenisIds) || empty($kategoriIds)) {
            echo "Seeder DokumenHukum dilewati karena tabel jenis/kategori kosong.\n";
            return;
        }

        // Bank Kata untuk Judul Indonesia
        $prefix = ['Peraturan', 'Keputusan', 'Surat Edaran', 'Instruksi', 'Berita Acara', 'Nota Dinas', 'Maklumat'];
        $pejabat = ['Kepala Desa', 'Sekretaris Desa', 'Ketua BPD', 'Panitia Pembangunan', 'Kepala Dusun', 'Karang Taruna'];
        $topik = [
            'tentang Anggaran Pendapatan Belanja Desa',
            'mengenai Ketertiban dan Keamanan Lingkungan',
            'terkait Pelaksanaan Lomba Kebersihan',
            'tentang Penyaluran Bantuan Langsung Tunai',
            'mengenai Renovasi Jalan Desa',
            'terkait Izin Usaha Mikro Kecil',
            'tentang Pengelolaan Bank Sampah',
            'mengenai Jadwal Ronda Malam',
            'terkait Pemanfaatan Tanah Kas Desa',
            'tentang Protokol Kesehatan Desa'
        ];

        for ($i = 1; $i <= 100; $i++) {
            $fileType = $faker->randomElement(['utama', 'lampiran']);

            // Merangkai Judul
            $judulBaru = $faker->randomElement($prefix) . ' ' .
                         $faker->randomElement($pejabat) . ' ' .
                         $faker->randomElement($topik) . ' Tahun ' . $faker->year();

            DB::table('dokumen_hukum')->insert([
                'jenis_id' => $faker->randomElement($jenisIds),
                'kategori_id' => $faker->randomElement($kategoriIds),
                'nomor' => $faker->unique()->regexify('[A-Z]{2}/[0-9]{3}/VI/[0-9]{4}'),
                'judul' => $judulBaru,
                'tanggal' => $faker->dateTimeBetween('-5 years', 'now'),
                'ringkasan' => 'Dokumen ini merupakan arsip resmi desa yang membahas secara rinci ' . strtolower($judulBaru) . '.',
                'status' => $faker->randomElement(['aktif', 'tidak_aktif']),
                'file_number' => DokumenHukum::generateFileNumber($fileType),
                'file_type' => $fileType,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
