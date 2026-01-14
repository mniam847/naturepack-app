<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Hapus user lama jika ada (biar tidak duplikat)
        \Illuminate\Support\Facades\DB::table('users')->truncate();

        // Buat akun Admin
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Admin Packaging',
            'email' => 'admin@example.com', // <--- Email Login Anda
            'password' => \Illuminate\Support\Facades\Hash::make('password123'), // <--- Password Anda
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
