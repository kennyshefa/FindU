<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Nadia (Sesuai Profile & Dashboard)
        User::updateOrCreate(
            ['email' => 'nadia@student.ub.ac.id'],
            [
                'name' => 'Nadia Nur Awwalia R',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Akun Umum (Sesuai placeholder Figma)
        User::updateOrCreate(
            ['email' => 'email@student.ub.ac.id'],
            [
                'name' => 'Nama Pengguna',
                'password' => Hash::make('password123'),
            ]
        );

        // 3. Akun Petugas
        User::updateOrCreate(
            ['email' => 'petugas@findu.ac.id'],
            [
                'name' => 'Petugas Satpam Gedung F',
                'password' => Hash::make('petugas123'),
            ]
        );
    }
}
