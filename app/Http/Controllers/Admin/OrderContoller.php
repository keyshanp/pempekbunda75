<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman order produk
     */
    public function index()
    {
        // Ambil semua produk dari database (hanya yang status aktif dan stok > 0)
        $products = Produk::where('status', true)
            ->where('stok', '>', 0)
            ->orderBy('nama_produk')
            ->get()
            ->map(function ($produk) {
                // Format data sesuai kebutuhan frontend
                return [
                    'id' => $produk->id,
                    'name' => $produk->nama_produk,
                    'price' => $produk->harga,
                    'image' => $produk->gambar 
                        ? asset('storage/' . $produk->gambar) 
                        : asset('assets/images/pempekbunda5.png'),
                    'description' => $produk->deskripsi ?? $this->getDefaultDescription($produk->nama_produk),
                    'funFact' => $this->generateFunFact($produk->nama_produk, $produk->deskripsi),
                    'ingredients' => $this->getIngredients($produk->nama_produk),
                    'stok' => $produk->stok
                ];
            });
        
        return view('order.index', compact('products'));
    }

    /**
     * MEMPROSES PESANAN - ROUTE order.process
     */
    public function process(Request $request)
    {
        // Ambil data dari session
        $cart = session()->get('cart', []);
        $paymentData = session()->get('payment_data', []);
        
        // Validasi data
        if (empty($cart)) {
            return response()->json([
                'success' => false, 
                'error' => 'Keranjang belanja kosong'
            ], 400);
        }
        
        if (empty($paymentData)) {
            return response()->json([
                'success' => false, 
                'error' => 'Data pembayaran tidak lengkap. Silakan isi form pembayaran terlebih dahulu.'
            ], 400);
        }
        
        // Generate kode pesanan unik
        $kodePesanan = 'PB' . now()->format('Ymd') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        // Format items dari cart
        $items = [];
        $subtotal = 0;
        
        foreach ($cart as $item) {
            $price = (int) ($item['price'] ?? 0);
            $quantity = (int) ($item['quantity'] ?? 1);
            $itemSubtotal = $price * $quantity;
            $subtotal += $itemSubtotal;
            
            $items[] = [
                'id' => $item['id'] ?? null,
                'name' => $item['name'] ?? 'Produk',
                'price' => $price,
                'quantity' => $quantity,
                'image' => $item['image'] ?? asset('assets/images/pempekbunda5.png'),
                'subtotal' => $itemSubtotal
            ];
        }
        
        // Hitung ongkir
        $shippingCost = (int) ($paymentData['delivery']['shipping_cost'] ?? 0);
        $total = $subtotal + $shippingCost;
        
        // Siapkan data order
        $orderData = [
            'kode_pesanan' => $kodePesanan,
            'user_id' => auth()->id(),
            'customer' => $paymentData['customer'] ?? [
                'nama' => 'Guest',
                'email' => '',
                'telepon' => '',
                'alamat' => ''
            ],
            'delivery' => $paymentData['delivery'] ?? [
                'metode' => 'pickup',
                'shipping_cost' => 0
            ],
            'payment' => $paymentData['payment'] ?? [
                'metode' => 'qris',
                'nama_pengirim' => ''
            ],
            'items' => $items,
            'subtotal' => $subtotal,
            'total' => $total,
            'status_pesanan' => 'pending',
            'status_pembayaran' => 'belum_bayar',
            'tanggal_pesanan' => now()->format('Y-m-d H:i:s'),
            'batas_pembayaran' => now()->addHours(12)->format('Y-m-d H:i:s'),
        ];
        
        // SIMPAN KE DATABASE (Order model)
        try {
            // Cek apakah order dengan kode ini sudah ada
            $existingOrder = Order::where('kode_pesanan', $kodePesanan)->first();
            if (!$existingOrder) {
                $order = Order::create([
                    'kode_pesanan' => $kodePesanan,
                    'user_id' => auth()->id(),
                    'customer' => $orderData['customer'],
                    'delivery' => $orderData['delivery'],
                    'payment' => $orderData['payment'],
                    'items' => $items,
                    'subtotal' => $subtotal,
                    'total' => $total,
                    'status_pesanan' => 'pending',
                    'status_pembayaran' => 'belum_bayar',
                    'tanggal_pesanan' => now(),
                    'batas_pembayaran' => now()->addHours(12),
                ]);
            }
        } catch (\Exception $e) {
            // Fallback ke session jika database error (TANPA LOG)
            $orders = session()->get('orders', []);
            $orders[$kodePesanan] = $orderData;
            session()->put('orders', $orders);
        }
        
        // Hapus data session
        session()->forget('cart');
        session()->forget('payment_data');
        
        // Kembalikan response sukses dengan redirect
        return response()->json([
            'success' => true,
            'redirect' => route('order.invoice', ['invoice' => $kodePesanan]),
            'invoice' => $kodePesanan
        ]);
    }

    /**
     * Menampilkan invoice pesanan
     */
    /**
 * Menampilkan invoice pesanan
 */
public function invoice($invoice)
{
    // Cari di database dulu
    $order = Order::where('kode_pesanan', $invoice)->first();
    
    if ($order) {
        // Data dari database - pastikan JSON di-decode dengan benar
        $orderData = [
            'kode_pesanan' => $order->kode_pesanan,
            'customer' => is_string($order->customer) ? json_decode($order->customer, true) : $order->customer,
            'delivery' => is_string($order->delivery) ? json_decode($order->delivery, true) : $order->delivery,
            'payment' => is_string($order->payment) ? json_decode($order->payment, true) : $order->payment,
            'items' => is_string($order->items) ? json_decode($order->items, true) : $order->items,
            'subtotal' => $order->subtotal,
            'total' => $order->total,
            'status_pesanan' => $order->status_pesanan,
            'status_pembayaran' => $order->status_pembayaran,
            'tanggal_pesanan' => $order->tanggal_pesanan->format('Y-m-d H:i:s'),
            'batas_pembayaran' => $order->batas_pembayaran->format('Y-m-d H:i:s'),
        ];
    } else {
        // Fallback ke session
        $orders = session()->get('orders', []);
        $orderData = $orders[$invoice] ?? null;
        
        if (!$orderData) {
            abort(404, 'Pesanan tidak ditemukan');
        }
    }
    
    return view('order.invoice', [
        'order' => $orderData,
        'title' => 'Invoice Pesanan - PempekBunda 75'
    ]);
}
    
    /**
     * Generate deskripsi default jika tidak ada di database
     */
    private function getDefaultDescription($namaProduk)
    {
        $descriptions = [
            'Kapal Selam' => 'Pempek ukuran besar dengan isian telur utuh di dalamnya. Tekstur kenyal dan rasa ikan tenggiri yang sangat terasa.',
            'Lenjer' => 'Pempek berbentuk panjang seperti lontong, dengan tekstur kenyal dan rasa gurih khas Palembang.',
            'Adaan' => 'Pempek bulat yang terbuat dari campuran ikan dan tepung, digoreng hingga kecokelatan.',
            'Kulit' => 'Pempek yang terbuat dari kulit ikan, memiliki tekstur kenyal dan renyah.',
            'Telur Kecil' => 'Pempek berukuran kecil dengan isian telur puyuh yang gurih.',
            'Campur' => 'Kombinasi lengkap berbagai varian pempek dalam satu paket hemat.'
        ];
        
        foreach ($descriptions as $key => $desc) {
            if (str_contains(strtolower($namaProduk), strtolower($key))) {
                return $desc;
            }
        }
        
        return 'Pempek khas Palembang dengan cita rasa autentik, dibuat dari ikan tenggiri segar pilihan.';
    }
    
    /**
     * Generate fun fact berdasarkan nama produk
     */
    private function generateFunFact($namaProduk, $deskripsi = null)
    {
        $funFacts = [
            'Kapal Selam' => 'Tahukah kamu? Nama "Kapal Selam" diberikan karena proses merebusnya. Pempek ini harus tenggelam dulu di dasar air mendidih, dan baru boleh diangkat setelah ia mengapung ke permukaan!',
            'Lenjer' => 'Pempek Lenjer adalah bentuk paling dasar dari semua pempek. Dari bentuk inilah para koki mulai berkreasi dengan berbagai variasi.',
            'Adaan' => 'Berbeda dengan pempek lain, Adaan langsung digoreng tanpa direbus dulu, itulah kenapa aromanya lebih wangi!',
            'Kulit' => 'Pempek Kulit dibuat dari sisa kulit ikan yang diolah, jadi nggak ada yang terbuang sia-sia!',
            'Telur Kecil' => 'Pempek Telur Kecil menggunakan telur puyuh yang lebih gurih dan cocok untuk camilan.',
            'Campur' => 'Paket Campur adalah pilihan tepat buat kamu yang ingin mencoba semua varian dalam satu piring!'
        ];
        
        foreach ($funFacts as $key => $fact) {
            if (str_contains(strtolower($namaProduk), strtolower($key))) {
                return $fact;
            }
        }
        
        if ($deskripsi) {
            return $deskripsi;
        }
        
        return 'PempekBunda 75 dibuat dengan ikan tenggiri segar tanpa pengawet, resep turun-temurun dari Palembang.';
    }
    
    /**
     * Generate daftar bahan berdasarkan nama produk
     */
    private function getIngredients($namaProduk)
    {
        $baseIngredients = ['Ikan Tenggiri Murni', 'Tepung Sagu', 'Garam', 'Bumbu Rahasia Bunda'];
        
        if (str_contains(strtolower($namaProduk), 'kapal selam')) {
            return array_merge($baseIngredients, ['Telur Ayam Segar']);
        }
        
        if (str_contains(strtolower($namaProduk), 'telur kecil')) {
            return array_merge($baseIngredients, ['Telur Puyuh']);
        }
        
        if (str_contains(strtolower($namaProduk), 'adaan')) {
            return ['Ikan Tenggiri', 'Santan', 'Bawang Merah Iris', 'Tepung Sagu'];
        }
        
        if (str_contains(strtolower($namaProduk), 'kulit')) {
            return ['Kulit Ikan', 'Ikan Tenggiri', 'Tepung Sagu', 'Bumbu'];
        }
        
        if (str_contains(strtolower($namaProduk), 'campur')) {
            return ['Semua Varian Pempek', 'Cuko Spesial Gula Batok'];
        }
        
        return $baseIngredients;
    }
}
