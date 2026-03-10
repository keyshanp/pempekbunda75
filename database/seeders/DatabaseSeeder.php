<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KategoriSeeder::class,
            ProdukSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            TransaksiSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}