<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateFirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan tidak ada user dengan email yang sama
        if (DB::table('users')->where('email', 'admin@email.com')->doesntExist()) {
            User::create([
                'name' => 'Admin Desa',
                'email' => 'admin@email.com',
                'password' => Hash::make('admin123'), // Password: admin123
            ]);
        }
    }
}
