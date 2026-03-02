<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    
    protected $fillable = [
        'kode_transaksi',
        'pesanan_id',  // Kolom ini harus ada di database
        'metode_pembayaran',
        'nama_bank',
        'nomor_rekening',
        'nama_pemilik_rekening',
        'jumlah_bayar',
        'bukti_pembayaran',
        'status',
        'waktu_pembayaran',
        'waktu_konfirmasi',
        'catatan',
    ];
    
    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
        'waktu_pembayaran' => 'datetime',
        'waktu_konfirmasi' => 'datetime',
    ];
    
    /**
     * Relasi ke Order (bukan Pesanan)
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'pesanan_id');
    }
    
    /**
     * Alias untuk kompatibilitas dengan kode lama
     */
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'pesanan_id');
    }
    
    /**
     * Generate kode transaksi unik
     */
    public function generateKodeTransaksi(): string
    {
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return 'TRX' . $date . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
    
    /**
     * Get status badge untuk filament
     */
    public function getStatusBadge(): string
    {
        $badges = [
            'pending' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
            'success' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Success</span>',
            'failed' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Failed</span>',
            'expired' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Expired</span>',
        ];
        
        return $badges[$this->status] ?? $badges['pending'];
    }
    
    /**
     * Get ikon metode pembayaran
     */
    public function getMetodePembayaranIcon(): string
    {
        $icons = [
            'cash' => '💵',
            'gopay' => '💰',
            'dana' => '💳',
            'ovo' => '🟣',
            'shopeepay' => '🛍️',
            'qris' => '📱',
            'transfer_bank' => '🏦',
            'kredit' => '💳',
        ];
        
        return $icons[$this->metode_pembayaran] ?? '💵';
    }
    
    /**
     * Get teks metode pembayaran
     */
    public function getMetodePembayaranText(): string
    {
        $texts = [
            'cash' => 'Cash',
            'gopay' => 'GoPay',
            'dana' => 'DANA',
            'ovo' => 'OVO',
            'shopeepay' => 'ShopeePay',
            'qris' => 'QRIS',
            'transfer_bank' => 'Transfer Bank',
            'kredit' => 'Kartu Kredit',
        ];
        
        return $texts[$this->metode_pembayaran] ?? 'Cash';
    }
}