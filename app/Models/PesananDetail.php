<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesananDetail extends Model
{
    protected $table = 'pesanan_details';
    
    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'quantity',
        'harga_satuan',
        'subtotal',
        'catatan_item',
    ];
    
    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];
    
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class);
    }
    
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}