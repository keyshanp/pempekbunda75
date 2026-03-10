<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        $shouldCreateTransaksi = false;
        
        // ✅ CEK APAKAH STATUS_PESANAN BERUBAH KE COMPLETED
        if ($order->isDirty('status_pesanan')) {
            $oldStatusPesanan = $order->getOriginal('status_pesanan');
            $newStatusPesanan = $order->status_pesanan;
            
            if ($newStatusPesanan === 'completed' && $oldStatusPesanan !== 'completed') {
                $shouldCreateTransaksi = true;
            }
            
            // ✅ KEMBALIKAN STOK JIKA ORDER DIBATALKAN
            if ($newStatusPesanan === 'cancelled' && $oldStatusPesanan !== 'cancelled') {
                $items = is_array($order->items) ? $order->items : json_decode($order->items, true);
                
                foreach ($items as $item) {
                    $produk = Produk::find($item['id']);
                    if ($produk) {
                        $produk->increment('stok', $item['quantity']);
                        Log::info("Stok produk '{$produk->nama_produk}' dikembalikan {$item['quantity']} via Observer. Stok sekarang: {$produk->stok}");
                    }
                }
            }
        }
        
        // ✅ CEK APAKAH STATUS_PEMBAYARAN BERUBAH KE SUDAH_BAYAR
        if ($order->isDirty('status_pembayaran')) {
            $oldStatusPembayaran = $order->getOriginal('status_pembayaran');
            $newStatusPembayaran = $order->status_pembayaran;
            
            if ($newStatusPembayaran === 'sudah_bayar' && $oldStatusPembayaran !== 'sudah_bayar') {
                $shouldCreateTransaksi = true;
            }
        }
        
        // ✅ BUAT TRANSAKSI OTOMATIS JIKA KONDISI TERPENUHI
        if ($shouldCreateTransaksi) {
            // Cek apakah transaksi sudah ada
            $existingTransaksi = Transaksi::where('pesanan_id', $order->id)->first();
            
            if (!$existingTransaksi) {
                // Generate kode transaksi unik
                $kodeTransaksi = 'TRX-' . now()->format('Ymd') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
                
                // Ambil metode pembayaran dari order
                $payment = is_array($order->payment) ? $order->payment : json_decode($order->payment, true);
                $metodePembayaran = $payment['metode'] ?? 'qris';
                
                // Mapping metode pembayaran
                $metodeMap = [
                    'qris' => 'qris',
                    'transfer' => 'transfer_bank',
                    'cod' => 'cash',
                    'gopay' => 'gopay',
                    'dana' => 'dana',
                    'ovo' => 'ovo',
                    'shopeepay' => 'shopeepay'
                ];
                
                $metodeFinal = $metodeMap[$metodePembayaran] ?? 'qris';
                
                // Tentukan status transaksi berdasarkan status order
                $statusTransaksi = 'success';
                if ($order->status_pesanan === 'completed') {
                    $statusTransaksi = 'success';
                } elseif ($order->status_pembayaran === 'sudah_bayar') {
                    $statusTransaksi = 'success';
                }
                
                // Buat transaksi
                Transaksi::create([
                    'kode_transaksi' => $kodeTransaksi,
                    'pesanan_id' => $order->id,
                    'metode_pembayaran' => $metodeFinal,
                    'jumlah_bayar' => $order->total,
                    'status' => $statusTransaksi,
                    'waktu_pembayaran' => now(),
                    'waktu_konfirmasi' => now(),
                    'catatan' => 'Transaksi otomatis dari order (status: ' . $order->status_pesanan . ', pembayaran: ' . $order->status_pembayaran . ')'
                ]);
                
                Log::info("Transaksi {$kodeTransaksi} dibuat otomatis untuk order {$order->kode_pesanan} via Observer (status_pesanan: {$order->status_pesanan}, status_pembayaran: {$order->status_pembayaran})");
            }
        }
    }
}
