<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'nama' => 'Pempek Lenjer', // ← PAKAI 'nama'
                'deskripsi' => 'Pempek lenjer klasik dengan tekstur kenyal',
                'aktif' => true // ← PAKAI 'aktif'
            ],
            [
                'nama' => 'Pempek Keriting',
                'deskripsi' => 'Pempek keriting dengan tekstur unik',
                'aktif' => true
            ],
            [
                'nama' => 'Pempek Kulit',
                'deskripsi' => 'Pempek kulit ikan yang renyah',
                'aktif' => true
            ],
            [
                'nama' => 'Pempek Telor',
                'deskripsi' => 'Pempek dengan isian telor ayam',
                'aktif' => true
            ],
            [
                'nama' => 'Pempek Kapal Selam',
                'deskripsi' => 'Pempek dengan isian telor utuh',
                'aktif' => true
            ],
            [
                'nama' => 'Pempek Adaan',
                'deskripsi' => 'Pempek berbentuk bulat',
                'aktif' => true
            ],
            [
                'nama' => 'Tanpa Kategori',
                'deskripsi' => 'Kategori default untuk produk yang belum memiliki kategori',
                'aktif' => true
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::firstOrCreate(
                ['slug' => Str::slug($kategori['nama'])],
                [
                    'nama' => $kategori['nama'],
                    'deskripsi' => $kategori['deskripsi'],
                    'aktif' => $kategori['aktif']
                ]
            );
        }

        $this->command->info('✅ ' . count($kategoris) . ' kategori berhasil ditambahkan!');
    }
}