<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 'feedback';
    
    protected $fillable = [
        'kode_pesanan',
        'user_id',
        'user_name',
        'user_email',
        'rating',
        'tags',
        'review',
    ];

    // 🔥 PASTIKAN INI ADA!
    protected $casts = [
        'tags' => 'array',
        'rating' => 'integer',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'kode_pesanan', 'kode_pesanan');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}