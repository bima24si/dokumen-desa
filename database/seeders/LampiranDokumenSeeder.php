<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LampiranDokumenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lampiran_dokumens')->truncate();

        // Mengambil array 'dokumen_id', BUKAN 'id'
        $dokumenIds = DB::table('dokumen_hukum')->pluck('dokumen_id')->toArray();

        if (empty($dokumenIds)) {
            echo "Seeder gagal: Tabel dokumen_hukum kosong.\n";
            return;
        }

        $lampiranData = [];
        $fileTypes = ['pdf', 'docx', 'jpg', 'png'];

        foreach ($dokumenIds as $index => $docId) {
            $ext = $fileTypes[array_rand($fileTypes)];
            $fileName = "lampiran_" . str_pad($index + 1, 3, '0', STR_PAD_LEFT) . "." . $ext;

            $lampiranData[] = [
                'dokumen_id'  => $docId, // ID ini valid karena diambil dari pluck('dokumen_id')
                'nama_file'   => $fileName,
                'path_file'   => 'storage/lampiran/' . $fileName,
                'tipe_file'   => 'Dokumen ' . strtoupper($ext),
                'ukuran_file' => rand(1000, 5000000),
                'keterangan'  => 'Lampiran dokumen resmi',
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        foreach (array_chunk($lampiranData, 50) as $chunk) {
            DB::table('lampiran_dokumens')->insert($chunk);
        }
    }
}
