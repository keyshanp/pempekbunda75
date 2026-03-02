<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users
        User::create([
            'name' => 'Admin Pempek',
            'email' => 'admin@pempek.com',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'name' => 'Admin Pempek',
            'email' => 'admin@pempekbunda75.com',
            'password' => Hash::make('Admin123!'),
        ]);

        // Create 10 random users
        User::factory(10)->create();
    }
}