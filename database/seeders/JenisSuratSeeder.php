<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSurat;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_surat' => 'Surat Pengantar KTP',
                'persyaratan' => '<ul><li>Fotokopi Kartu Keluarga (KK)</li><li>Surat Pengantar RT/RW</li><li>Pas Foto 3x4 (2 Lembar)</li></ul>',
            ],
            [
                'nama_surat' => 'Surat Keterangan Usaha (SKU)',
                'persyaratan' => '<ul><li>Fotokopi KTP & KK</li><li>Surat Pengantar RT/RW</li><li>Bukti Kepemilikan Tempat Usaha/Sewa</li></ul>',
            ],
            [
                'nama_surat' => 'Surat Keterangan Domisili',
                'persyaratan' => '<ul><li>Fotokopi KTP & KK</li><li>Surat Pengantar RT/RW</li><li>Surat Pernyataan Tidak Keberatan dari Pemilik Rumah (jika sewa)</li></ul>',
            ],
            [
                'nama_surat' => 'Surat Keterangan Tidak Mampu (SKTM)',
                'persyaratan' => '<ul><li>Fotokopi KTP & KK</li><li>Surat Pengantar RT/RW</li><li>Foto Rumah (Tampak Depan & Dalam)</li></ul>',
            ],
        ];

        foreach ($data as $item) {
            JenisSurat::create($item);
        }
    }
}