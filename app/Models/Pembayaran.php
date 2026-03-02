<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembelian_id',
        'metode',
        'bayar',
        'kembalian',
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
}
