<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin di tabel users (untuk Filament)
        User::updateOrCreate(
            ['email' => 'admin@pempekbunda75.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin123!'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'superadmin@pempekbunda75.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('SuperAdmin123!'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'bunda75@pempekbunda75.com'],
            [
                'name' => 'Pempek Bunda',
                'password' => Hash::make('Pempek123!'),
                'is_admin' => true,
            ]
        );
    }
}
