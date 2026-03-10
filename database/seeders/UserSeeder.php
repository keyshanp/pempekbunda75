<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User biasa (bukan admin) - gunakan updateOrCreate untuk menghindari duplikat
        User::updateOrCreate(
            ['email' => 'customer1@example.com'],
            [
                'name' => 'Customer Satu',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer2@example.com'],
            [
                'name' => 'Customer Dua',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer3@example.com'],
            [
                'name' => 'Customer Tiga',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ]
        );

        echo "✅ User customers berhasil ditambahkan!\n";
    }
}
