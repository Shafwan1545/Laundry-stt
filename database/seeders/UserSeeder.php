<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Owner
        User::create([
            'name' => 'Pemilik Laundry',
            'email' => 'owner@freshlaundry.com',
            'phone' => '081234567890',
            'password' => Hash::make('password123'),
            'role' => 'owner',
            'address' => 'Kantor Pusat FreshLaundry',
        ]);

        // 2. Akun Kasir
        User::create([
            'name' => 'Siti Kasir',
            'email' => 'kasir@freshlaundry.com',
            'phone' => '081298765432',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
            'address' => 'Outlet Cabang Utama',
        ]);

        // 3. Akun Pelanggan Contoh
        User::create([
            'name' => 'Ahmad Pelanggan',
            'email' => 'ahmad@gmail.com',
            'phone' => '085712345678',
            'password' => Hash::make('password123'),
            'role' => 'pelanggan',
            'address' => 'Jl. Mawar No. 12',
        ]);
    }
}