<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Order;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua orders yang ada
        $orders = Order::all();
        
        if ($orders->isEmpty()) {
            echo "⚠️ Tidak ada order. Jalankan OrderSeeder terlebih dahulu!\n";
            return;
        }
        
        // Metode pembayaran sesuai enum di migration
        $metodePembayaran = ['cash', 'gopay', 'dana', 'ovo', 'shopeepay', 'qris', 'transfer_bank', 'kredit'];
        
        // Status sesuai enum di migration
        $statusList = ['pending', 'success', 'failed', 'expired'];
        
        // Bank untuk transfer_bank
        $banks = ['BCA', 'Mandiri', 'BNI', 'BRI', 'CIMB Niaga', 'Permata', 'Danamon'];
        
        $transaksiCount = 0;
        
        foreach ($orders as $order) {
            // Skip jika order sudah punya transaksi
            if ($order->transaksis()->exists()) {
                continue;
            }
            
            // Random metode pembayaran
            $metode = $metodePembayaran[array_rand($metodePembayaran)];
            
            // Random status dengan distribusi realistis:
            // 70% success, 20% pending, 8% failed, 2% expired
            $rand = rand(1, 100);
            if ($rand <= 70) {
                $status = 'success';
            } elseif ($rand <= 90) {
                $status = 'pending';
            } elseif ($rand <= 98) {
                $status = 'failed';
            } else {
                $status = 'expired';
            }
            
            // Generate kode transaksi (format: TRX + YYYYMMDD + 4 digit)
            $date = $order->created_at->format('Ymd');
            $kodeTransaksi = 'TRX' . $date . str_pad($transaksiCount + 1, 4, '0', STR_PAD_LEFT);
            
            // Data transaksi sesuai struktur migration
            $transaksiData = [
                'kode_transaksi' => $kodeTransaksi,
                'pesanan_id' => $order->id,
                'metode_pembayaran' => $metode,
                'jumlah_bayar' => $order->total,
                'status' => $status,
                'created_at' => $order->created_at,
                'updated_at' => $order->created_at,
            ];
            
            // Jika metode transfer_bank, tambahkan detail bank (sesuai migration)
            if ($metode === 'transfer_bank') {
                $transaksiData['nama_bank'] = $banks[array_rand($banks)];
                $transaksiData['nomor_rekening'] = rand(1000000000, 9999999999);
                $customerData = is_array($order->customer) ? $order->customer : json_decode($order->customer, true);
                $transaksiData['nama_pemilik_rekening'] = $customerData['nama'] ?? 'Customer';
            }
            
            // Set waktu dan catatan berdasarkan status
            if ($status === 'success') {
                // Transaksi berhasil
                $waktuBayar = $order->created_at->copy()->addMinutes(rand(5, 60));
                $waktuKonfirmasi = $waktuBayar->copy()->addMinutes(rand(5, 30));
                
                $transaksiData['waktu_pembayaran'] = $waktuBayar;
                $transaksiData['waktu_konfirmasi'] = $waktuKonfirmasi;
                $transaksiData['catatan'] = 'Pembayaran berhasil diverifikasi oleh admin';
                
                // Update status order
                $order->update([
                    'status_pembayaran' => 'sudah_bayar',
                    'status_pesanan' => 'paid'
                ]);
                
            } elseif ($status === 'pending') {
                // Menunggu konfirmasi
                $waktuBayar = $order->created_at->copy()->addMinutes(rand(5, 120));
                $transaksiData['waktu_pembayaran'] = $waktuBayar;
                $transaksiData['catatan'] = 'Menunggu konfirmasi pembayaran dari admin';
                
            } elseif ($status === 'failed') {
                // Pembayaran gagal
                $transaksiData['catatan'] = 'Pembayaran gagal atau dibatalkan oleh customer';
                
            } else {
                // Expired
                $transaksiData['catatan'] = 'Pembayaran melewati batas waktu yang ditentukan';
            }
            
            // Buat transaksi sesuai struktur migration
            Transaksi::create($transaksiData);
            $transaksiCount++;
        }
        
        echo "✅ {$transaksiCount} transaksi berhasil ditambahkan!\n";
    }
}
