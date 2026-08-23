<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Super Admin Utama (Permanen & Terproteksi)
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@insphony.com',
                'telepon' => '081234567890',
                'alamat' => 'Insphony HQ',
                'password' => Hash::make('admin123'),
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ]
        );

        // Akun Pengguna / User Demo
        User::updateOrCreate(
            ['username' => 'andika'],
            [
                'name' => 'andika',
                'email' => 'andika@gmail.com',
                'telepon' => '089524003130',
                'alamat' => 'bengkong',
                'password' => Hash::make('andika123'),
                'role' => User::ROLE_USER,
                'email_verified_at' => now(),
            ]
        );
    }
}
