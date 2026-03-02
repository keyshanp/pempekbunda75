<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'status',
        // 🔥 HAPUS: 'kategori_id', 'berat', 'diskon', 'slug'
    ];

    protected $casts = [
        'status' => 'boolean',
        'harga' => 'integer',
        'stok' => 'integer',
    ];

    protected $appends = ['harga_formatted'];

    // 🔥 HAPUS boot method karena slug sudah tidak ada
    // protected static function boot()
    // {
    //     parent::boot();
    //     ...
    // }

    public function getHargaFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->status ? 'Tersedia' : 'Habis';
    }

    public function getStokStatusAttribute(): array
    {
        if ($this->stok > 10) {
            return ['color' => '#8C9440', 'icon' => 'check-circle'];
        } elseif ($this->stok > 0) {
            return ['color' => '#BC5A42', 'icon' => 'exclamation-triangle'];
        } else {
            return ['color' => '#EF4444', 'icon' => 'x-circle'];
        }
    }

    // 🔥 HAPUS relasi kategori karena kolom kategori_id sudah dihapus
    // public function kategori(): BelongsTo
    // {
    //     return $this->belongsTo(Kategori::class);
    // }
}