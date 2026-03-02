<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // database/seeders/DatabaseSeeder.php
public function run(): void
{
    \App\Models\Kategori::insert([
        ['nama' => 'Paket Campur', 'slug' => 'paket-campur', 'aktif' => true],
        ['nama' => 'Satuan', 'slug' => 'satuan', 'aktif' => true],
        ['nama' => 'Pelengkap', 'slug' => 'pelengkap', 'aktif' => true],
    ]);

    \App\Models\Produk::insert([
        [
            'nama_produk' => 'Paket Campur Special',
            'slug' => 'paket-campur-special',
            'deskripsi' => 'Paket lengkap dengan berbagai jenis pempek',
            'kategori_id' => 1,
            'harga' => 45000,
            'stok' => 25,
            'status' => true,
        ],
        [
            'nama_produk' => 'Pempek Kapal Selam',
            'slug' => 'pempek-kapal-selam',
            'deskripsi' => 'Pempek dengan telur ayam di dalamnya',
            'kategori_id' => 2,
            'harga' => 15000,
            'stok' => 50,
            'status' => true,
        ],
        [
            'nama_produk' => 'Cuko Pempek',
            'slug' => 'cuko-pempek',
            'deskripsi' => 'Kuah khas pempek Palembang',
            'kategori_id' => 3,
            'harga' => 5000,
            'stok' => 100,
            'status' => true,
        ],
    ]);
}
}