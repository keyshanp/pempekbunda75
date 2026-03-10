<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$completedOrders = \App\Models\Order::where('status_pesanan', 'completed')->get();

echo "=== ORDERS COMPLETED ===\n\n";
foreach ($completedOrders as $order) {
    $transaksi = \App\Models\Transaksi::where('pesanan_id', $order->id)->first();
    
    echo "Order ID: {$order->id}\n";
    echo "Kode Pesanan: {$order->kode_pesanan}\n";
    echo "Total: Rp " . number_format($order->total, 0, ',', '.') . "\n";
    echo "Created: {$order->created_at}\n";
    echo "Transaksi: " . ($transaksi ? "✅ Ada (TRX: {$transaksi->kode_transaksi})" : "❌ TIDAK ADA") . "\n";
    echo "---\n";
}

echo "\nTotal completed orders: " . $completedOrders->count() . "\n";
echo "Orders tanpa transaksi: " . $completedOrders->filter(function($o) {
    return !\App\Models\Transaksi::where('pesanan_id', $o->id)->exists();
})->count() . "\n";
