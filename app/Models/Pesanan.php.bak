<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'orders'; // PENTING: tabel di database adalah 'orders'
    
    protected $fillable = [
        'kode_pesanan',
        'user_id',
        'nama_pemesan',
        'email',
        'telepon',
        'alamat_pengiriman',
        'metode_pengiriman',
        'ongkos_kirim',
        'status_pesanan',
        'status_pembayaran',
        'total_harga',
        'total_bayar',
        'catatan',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
        'total_harga' => 'decimal:2',
        'total_bayar' => 'decimal:2',
        'ongkos_kirim' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'pesanan_id');
    }

    public function details()
    {
        return $this->hasMany(PesananDetail::class, 'pesanan_id');
    }

    public function generateKodePesanan(): string
    {
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return 'PB' . $date . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function getStatusBadge(): string
    {
        $badges = [
            'pending' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
            'diproses' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Diproses</span>',
            'dikirim' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Dikirim</span>',
            'selesai' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>',
            'dibatalkan' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>',
        ];
        
        return $badges[$this->status_pesanan] ?? $badges['pending'];
    }

    public function getPembayaranBadge(): string
    {
        $badges = [
            'belum_bayar' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Belum Bayar</span>',
            'menunggu_konfirmasi' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Konfirmasi</span>',
            'lunas' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>',
            'gagal' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Gagal</span>',
        ];
        
        return $badges[$this->status_pembayaran] ?? $badges['belum_bayar'];
    }
}