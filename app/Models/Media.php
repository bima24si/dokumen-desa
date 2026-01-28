<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    // Kita extend agar jika nanti butuh customisasi, bisa dilakukan di sini.
    // Hubungan ke tabel lain sudah dihandle otomatis oleh Spatie.
}
