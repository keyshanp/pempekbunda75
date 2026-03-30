<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - {{ $order->kode_pesanan }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @font-face {
            font-family: 'RASCAL';
            src: url('{{ asset("fonts/RASCAL__.TTF") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        
        .font-rascal {
            font-family: 'RASCAL', cursive;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FDF8F3;
        }
        
        .status-badge {
            @apply px-3 py-1 rounded-full text-xs font-semibold;
        }
    </style>
</head>
<body class="min-h-screen p-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ url('/admin/orders') }}" class="text-[#C06044] hover:underline flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar Pesanan
            </a>
            <h1 class="text-3xl font-rascal text-[#C06044]">Detail Pesanan</h1>
        </div>
        
        @php
            // 🔥 PERBAIKAN: Cek tipe data dan decode dengan benar
            $customer = is_string($order->customer) ? json_decode($order->customer, true) : (is_array($order->customer) ? $order->customer : []);
            $delivery = is_string($order->delivery) ? json_decode($order->delivery, true) : (is_array($order->delivery) ? $order->delivery : []);
            $payment = is_string($order->payment) ? json_decode($order->payment, true) : (is_array($order->payment) ? $order->payment : []);
            $items = is_string($order->items) ? json_decode($order->items, true) : (is_array($order->items) ? $order->items : []);
        @endphp
        
        <!-- Order Info -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <p class="text-sm text-gray-500">ID Pesanan</p>
                    <p class="text-2xl font-bold text-[#C06044]">{{ $order->kode_pesanan }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Tanggal</p>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</p>
                </div>
            </div>
            
            <!-- Status -->
            @php
                $statuses = ['pending', 'paid', 'processed', 'shipped', 'completed'];
                $labels = ['Menunggu', 'Dibayar', 'Diproses', 'Dikirim', 'Selesai'];
                $currentIndex = array_search($order->status_pesanan, $statuses);
                if ($currentIndex === false) $currentIndex = 0;
            @endphp
            
            <div class="grid grid-cols-5 gap-4 mb-8">
                @foreach($statuses as $index => $status)
                    <div class="text-center">
                        <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center mb-2
                            {{ $index <= $currentIndex ? 'bg-[#C06044] text-white' : 'bg-gray-200 text-gray-400' }}">
                            @if($index < $currentIndex)
                                <i class="fas fa-check"></i>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <span class="text-xs {{ $index == $currentIndex ? 'text-[#C06044] font-bold' : 'text-gray-400' }}">
                            {{ $labels[$index] }}
                        </span>
                    </div>
                @endforeach
            </div>
            
            <!-- Customer Info -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div class="p-4 bg-orange-50 rounded-xl">
                    <h3 class="font-bold mb-3 flex items-center gap-2">
                        <i class="fas fa-user text-[#C06044]"></i>
                        Data Pemesan
                    </h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="text-gray-500">Nama:</span> {{ $customer['nama'] ?? '-' }}</p>
                        <p><span class="text-gray-500">Email:</span> {{ $customer['email'] ?? '-' }}</p>
                        <p><span class="text-gray-500">Telepon:</span> {{ $customer['telepon'] ?? '-' }}</p>
                        <p><span class="text-gray-500">Alamat:</span> {{ $customer['alamat'] ?? '-' }}</p>
                    </div>
                </div>
                
                <div class="p-4 bg-orange-50 rounded-xl">
                    <h3 class="font-bold mb-3 flex items-center gap-2">
                        <i class="fas fa-truck text-[#C06044]"></i>
                        Informasi Pengiriman
                    </h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="text-gray-500">Metode:</span> {{ $delivery['metode'] ?? '-' }}</p>
                        <p><span class="text-gray-500">Ongkos Kirim:</span> Rp {{ number_format($delivery['shipping_cost'] ?? 0, 0, ',', '.') }}</p>
                        <p><span class="text-gray-500">Jarak:</span> {{ $customer['jarak'] ?? 0 }} km</p>
                    </div>
                </div>
            </div>
            
            <!-- Items -->
            <h3 class="font-bold mb-3 flex items-center gap-2">
                <i class="fas fa-shopping-bag text-[#C06044]"></i>
                Detail Pesanan
            </h3>
            <div class="space-y-3 mb-6">
                @foreach($items as $item)
                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                    <img src="{{ $item['image'] ?? asset('assets/images/pempekbunda5.png') }}" 
                         alt="{{ $item['name'] }}" 
                         class="w-16 h-16 rounded-lg object-cover">
                    <div class="flex-1">
                        <p class="font-bold">{{ $item['name'] }}</p>
                        <p class="text-sm text-gray-500">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                    </div>
                    <p class="font-bold text-[#C06044]">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
            
            <!-- Total -->
            <div class="border-t pt-4">
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span class="font-medium">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Ongkos Kirim</span>
                    <span class="font-medium">
                        @if(($delivery['shipping_cost'] ?? 0) == 0)
                            GRATIS
                        @else
                            Rp {{ number_format($delivery['shipping_cost'] ?? 0, 0, ',', '.') }}
                        @endif
                    </span>
                </div>
                <div class="flex justify-between text-xl font-bold mt-4 pt-4 border-t">
                    <span>Total</span>
                    <span class="text-[#C06044]">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="flex gap-4 justify-end">
            <a href="{{ route('order.invoice', ['invoice' => $order->kode_pesanan]) }}" target="_blank"
               class="px-6 py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors flex items-center gap-2">
                <i class="fas fa-print"></i>
                Lihat Invoice
            </a>
            <a href="https://wa.me/{{ $customer['telepon'] ?? '' }}" target="_blank"
               class="px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors flex items-center gap-2">
                <i class="fab fa-whatsapp"></i>
                Hubungi Customer
            </a>
        </div>
    </div>
</body>
</html>