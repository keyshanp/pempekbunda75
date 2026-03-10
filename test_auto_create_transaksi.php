<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TEST AUTO CREATE TRANSAKSI ===\n\n";

// Ambil order pertama yang belum completed
$order = \App\Models\Order::where('status_pesanan', '!=', 'completed')->first();

if (!$order) {
    echo "❌ Tidak ada order yang bisa ditest\n";
    exit;
}

echo "Order sebelum update:\n";
echo "  ID: {$order->id}\n";
echo "  Kode: {$order->kode_pesanan}\n";
echo "  Status: {$order->status_pesanan}\n";
echo "  Total: Rp " . number_format($order->total, 0, ',', '.') . "\n\n";

// Cek transaksi sebelum
$transaksiSebelum = \App\Models\Transaksi::where('pesanan_id', $order->id)->count();
echo "Transaksi sebelum: {$transaksiSebelum}\n\n";

// Update status ke completed
$oldStatus = $order->status_pesanan;
$order->status_pesanan = 'completed';
$order->save();

echo "✅ Status diubah ke: completed\n\n";

// Cek transaksi sesudah
$transaksiSesudah = \App\Models\Transaksi::where('pesanan_id', $order->id)->count();
echo "Transaksi sesudah: {$transaksiSesudah}\n\n";

if ($transaksiSesudah > $transaksiSebelum) {
    $transaksi = \App\Models\Transaksi::where('pesanan_id', $order->id)->latest()->first();
    echo "✅ SUKSES! Transaksi dibuat otomatis:\n";
    echo "  Kode: {$transaksi->kode_transaksi}\n";
    echo "  Metode: {$transaksi->metode_pembayaran}\n";
    echo "  Jumlah: Rp " . number_format($transaksi->jumlah_bayar, 0, ',', '.') . "\n";
    echo "  Status: {$transaksi->status}\n";
} else {
    echo "❌ GAGAL! Transaksi TIDAK dibuat otomatis\n";
    echo "Kemungkinan penyebab:\n";
    echo "- Model Observer tidak terdaftar\n";
    echo "- Event listener tidak berjalan\n";
    echo "- Kode auto-create tidak dipanggil\n";
}
