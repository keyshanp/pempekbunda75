<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Produk;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil users customer (bukan admin)
        $users = User::where('is_admin', false)->get();
        $produks = Produk::where('status', true)->get();
        
        if ($users->isEmpty()) {
            echo "⚠️ Tidak ada user customer. Jalankan UserSeeder terlebih dahulu!\n";
            return;
        }
        
        if ($produks->isEmpty()) {
            echo "⚠️ Tidak ada produk. Jalankan ProdukSeeder terlebih dahulu!\n";
            return;
        }
        
        $shippingMethods = ['pickup', 'instant', 'sameday'];
        $statusPesananList = ['pending', 'paid', 'processed', 'shipped', 'completed'];
        $statusPembayaranList = ['belum_bayar', 'sudah_bayar'];
        
        $orderCount = 0;
        
        // Buat 25 order sample dari berbagai customer
        for ($i = 1; $i <= 25; $i++) {
            $user = $users->random();
            $tanggalPesanan = Carbon::now()->subDays(rand(1, 30))->subHours(rand(0, 23));
            
            // Random 1-5 items per order
            $itemCount = rand(1, 5);
            $items = [];
            $subtotal = 0;
            
            for ($j = 0; $j < $itemCount; $j++) {
                $produk = $produks->random();
                $quantity = rand(1, 4);
                $price = $produk->harga;
                
                $items[] = [
                    'id' => $produk->id,
                    'name' => $produk->nama_produk,
                    'price' => $price,
                    'quantity' => $quantity,
                    'image' => $produk->gambar ? asset('storage/' . $produk->gambar) : null,
                ];
                
                $subtotal += $price * $quantity;
            }
            
            // Random shipping method
            $shippingMethod = $shippingMethods[array_rand($shippingMethods)];
            $shippingCost = $shippingMethod === 'pickup' ? 0 : rand(10000, 50000);
            $total = $subtotal + $shippingCost;
            
            // Customer data (sesuai struktur JSON di migration)
            $customer = [
                'nama' => $user->name,
                'email' => $user->email,
                'telepon' => '08' . rand(1000000000, 9999999999),
                'alamat' => 'Jl. Contoh No. ' . rand(1, 100) . ', Palembang, Sumatera Selatan',
                'lat' => -2.9911503 + (rand(-100, 100) / 1000),
                'lng' => 104.7532176 + (rand(-100, 100) / 1000),
            ];
            
            // Delivery data (sesuai struktur JSON di migration)
            $delivery = [
                'metode' => $shippingMethod,
                'shipping_cost' => $shippingCost,
                'jarak' => $shippingMethod === 'pickup' ? 0 : rand(1, 20),
            ];
            
            // Payment data (sesuai struktur JSON di migration)
            $paymentMethods = ['qris', 'gopay', 'dana', 'ovo', 'shopeepay'];
            $payment = [
                'metode' => $paymentMethods[array_rand($paymentMethods)],
                'nama_pengirim' => $user->name,
            ];
            
            // Generate kode pesanan (format: PB + YYYYMMDD + 4 digit)
            $kodePesanan = 'PB' . $tanggalPesanan->format('Ymd') . str_pad($i, 4, '0', STR_PAD_LEFT);
            
            // Random status
            $statusPesanan = $statusPesananList[array_rand($statusPesananList)];
            $statusPembayaran = $statusPembayaranList[array_rand($statusPembayaranList)];
            
            // Buat order sesuai struktur migration
            Order::create([
                'kode_pesanan' => $kodePesanan,
                'user_id' => $user->id,
                'customer' => $customer,
                'delivery' => $delivery,
                'payment' => $payment,
                'items' => $items,
                'subtotal' => $subtotal,
                'total' => $total,
                'status_pesanan' => $statusPesanan,
                'status_pembayaran' => $statusPembayaran,
                'tanggal_pesanan' => $tanggalPesanan,
                'batas_pembayaran' => $tanggalPesanan->copy()->addHours(24),
                'catatan_admin' => null,
                'created_at' => $tanggalPesanan,
                'updated_at' => $tanggalPesanan,
            ]);
            
            $orderCount++;
        }
        
        echo "✅ {$orderCount} orders berhasil ditambahkan!\n";
    }
}
