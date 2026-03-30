<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama dengan disable FK checks dulu (PostgreSQL compatible)
        DB::statement('SET session_replication_role = replica;');
        DB::table('produks')->truncate();
        DB::statement('SET session_replication_role = origin;');
        
        DB::table('produks')->insert([
            [
                'nama_produk' => 'Paket A - Pempek Campur',
                'deskripsi' => 'Berisi 3 lenjer, 2 keriting, 1 kapal selam, dan cuko',
                'harga' => 45000,
                'stok' => 50,
                'gambar' => null,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Paket B - Pempek Lenjer',
                'deskripsi' => 'Berisi 5 lenjer besar dengan cuko spesial',
                'harga' => 35000,
                'stok' => 30,
                'gambar' => null,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Paket C - Pempek Mini',
                'deskripsi' => 'Berisi 10 pempek kecil campur (adaan, keriting mini)',
                'harga' => 25000,
                'stok' => 100,
                'gambar' => null,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Paket D - Pempek Istimewa',
                'deskripsi' => 'Berisi 2 kapal selam, 2 lenjer, 2 kulit, cuko extra',
                'harga' => 55000,
                'stok' => 25,
                'gambar' => null,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Cuko Spesial 250ml',
                'deskripsi' => 'Kuah cuko khas Palembang dengan level pedas sedang',
                'harga' => 15000,
                'stok' => 200,
                'gambar' => null,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}