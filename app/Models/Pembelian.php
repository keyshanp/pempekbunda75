<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'total_harga',
        'status',
    ];

    /**
     * Pembelian punya banyak item
     */
    public function items(): HasMany
    {
        return $this->hasMany(PembelianItem::class);
    }

    /**
     * Pembelian punya satu pembayaran
     */
    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class);
    }
}
