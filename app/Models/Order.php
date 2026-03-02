<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne; // 🔥 TAMBAHKAN INI

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    
    protected $fillable = [
        'kode_pesanan',
        'user_id',
        'customer',
        'delivery',
        'payment',
        'items',
        'subtotal',
        'total',
        'status_pesanan',
        'status_pembayaran',
        'tanggal_pesanan',
        'batas_pembayaran',
        'catatan_admin',
    ];

    protected $casts = [
        'customer' => 'array',
        'delivery' => 'array',
        'payment' => 'array',
        'items' => 'array',
        'subtotal' => 'float',
        'total' => 'float',
        'tanggal_pesanan' => 'datetime',
        'batas_pembayaran' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Transaksi
     */
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'pesanan_id');
    }

        public function feedback()
{
    return $this->hasOne(Feedback::class, 'kode_pesanan', 'kode_pesanan');
}

    /**
     * Generate kode pesanan unik
     */
    public static function generateKodePesanan(): string
    {
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return 'PB' . $date . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get status badge untuk filament
     */
    public function getStatusPesananBadge(): string
    {
        $badges = [
            'pending' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>',
            'paid' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Dibayar</span>',
            'processed' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Diproses</span>',
            'shipped' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Dikirim</span>',
            'completed' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>',
            'cancelled' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>',
        ];
        
        return $badges[$this->status_pesanan] ?? $badges['pending'];
    }

    /**
     * Get status pembayaran badge
     */
    public function getStatusPembayaranBadge(): string
    {
        $badges = [
            'belum_bayar' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Belum Bayar</span>',
            'sudah_bayar' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Sudah Bayar</span>',
            'verifikasi' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Perlu Verifikasi</span>',
            'gagal' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Gagal</span>',
        ];
        
        return $badges[$this->status_pembayaran] ?? $badges['belum_bayar'];
    }

    /**
     * Accessor untuk mendapatkan data customer sebagai array
     */
    public function getCustomerAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : $value;
    }

    /**
     * Accessor untuk mendapatkan data delivery sebagai array
     */
    public function getDeliveryAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : $value;
    }

    /**
     * Accessor untuk mendapatkan data payment sebagai array
     */
    public function getPaymentAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : $value;
    }

    /**
     * Accessor untuk mendapatkan data items sebagai array
     */
    public function getItemsAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : $value;
    }
}