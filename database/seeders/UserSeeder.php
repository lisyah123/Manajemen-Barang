<?php

namespace Database\Seeders;

use App\Models\User;
// ini wajib nambah ini
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// ini juga
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Akun Super Admin
        User::create([
            'name' => 'Super Admin Inventory',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        // 2. Buat Akun Admin (Petugas Gudang)
        User::create([
            'name' => 'Admin Gudang',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('katasandi'),
            'role' => 'admin',
        ]);

        // 3. Buat Akun Pengguna (Staff)
        User::create([
            'name' => 'Staff Biasa',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'pengguna',
        ]);
    }
}
