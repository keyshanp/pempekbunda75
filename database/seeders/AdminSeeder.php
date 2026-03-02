<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@pempekbunda75.com',
                'password' => Hash::make('Admin123!'),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@pempekbunda75.com',
                'password' => Hash::make('SuperAdmin123!'),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pempek Bunda',
                'email' => 'bunda75@pempekbunda75.com',
                'password' => Hash::make('Pempek123!'),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}