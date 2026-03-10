<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$completedOrders = \App\Models\Order::where('status_pesanan', 'completed')
    ->whereDoesntHave('transaksis')
    ->get();

echo "=== CREATING MISSING TRANSAKSI ===\n\n";

foreach ($completedOrders as $order) {
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
    
    // Buat transaksi
    $transaksi = \App\Models\Transaksi::create([
        'kode_transaksi' => $kodeTransaksi,
        'pesanan_id' => $order->id,
        'metode_pembayaran' => $metodeFinal,
        'jumlah_bayar' => $order->total,
        'status' => 'success',
        'waktu_pembayaran' => $order->created_at,
        'waktu_konfirmasi' => $order->updated_at,
        'catatan' => 'Transaksi dibuat manual untuk order completed yang belum punya transaksi'
    ]);
    
    echo "✅ Created: {$kodeTransaksi}\n";
    echo "   Order: {$order->kode_pesanan}\n";
    echo "   Amount: Rp " . number_format($order->total, 0, ',', '.') . "\n";
    echo "   Method: {$metodeFinal}\n";
    echo "---\n";
}

echo "\nTotal transaksi created: " . $completedOrders->count() . "\n";
