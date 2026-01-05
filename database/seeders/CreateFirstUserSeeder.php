<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class CreateFirstUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pastikan Admin Utama ada
        User::firstOrCreate(
            ['email' => 'admin@email.com'], // Cek berdasarkan email
            [
                'name' => 'Admin Desa',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Tambahkan user dummy hingga total mencapai 100
        $currentCount = User::count();
        $targetCount = 100;

        if ($currentCount < $targetCount) {
            User::factory($targetCount - $currentCount)->create();
        }
    }
}
