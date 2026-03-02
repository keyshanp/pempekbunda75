<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pesanan - Pempek Bunda 75</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- RASCAL FONT -->
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
    </style>
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Reenie+Beanie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&family=Coming+Soon&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            font-family: 'Bubblegum Sans', cursive;
            background-color: #FFF8EE;
            color: #5C3D2E;
            margin: 0;
            padding: 0;
        }
        
        .font-rascal {
            font-family: 'RASCAL', cursive;
        }
        
        .font-reenie {
            font-family: 'Reenie Beanie', cursive;
        }
        
        .font-handwritten {
            font-family: 'Coming Soon', cursive;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .countdown {
            font-family: 'Courier New', monospace;
        }
        
        /* ===== HEADER STYLES ===== */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 80px;
            background: rgba(255, 255, 255, 0.95);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999999;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-link {
            display: block;
            text-decoration: none;
        }

        .brand-logo {
            width: 150px;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: scale(1.05);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .nav {
            display: flex;
            gap: 40px;
        }

        .nav-link {
            text-decoration: none;
            color: #000;
            font-size: clamp(20px, 2.5vw, 32px);
            position: relative;
            padding: 5px 0;
            cursor: pointer;
            font-family: 'Reenie Beanie', cursive;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 3px;
            background: #c97b63;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #c97b63;
        }

        .btn-header {
            background: #c97b63;
            color: #fff;
            padding: 10px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-size: clamp(18px, 2vw, 26px);
            font-weight: bold;
            transition: all 0.3s ease;
            border: 2px solid #c97b63;
            white-space: nowrap;
            font-family: 'Reenie Beanie', cursive;
        }

        .btn-header:hover {
            background: #b55242;
            border-color: #b55242;
            transform: translateY(-2px);
        }

        /* ===== FOOTER STYLES ===== */
        .footer {
            background: #b55242;
            color: #fff;
            padding: 60px 120px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin: 0;
            flex-shrink: 0;
        }

        .footer-left {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-link {
            color: #fff;
            text-decoration: none;
            font-size: clamp(20px, 2.2vw, 32px);
            padding: 3px 0;
            cursor: pointer;
            transition: color 0.3s ease;
            display: inline-block;
            font-family: 'Reenie Beanie', cursive;
        }

        .footer-link:hover {
            color: #ffd9cc;
        }

        .footer-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .footer-logo-link {
            display: block;
            text-decoration: none;
        }

        .footer-logo {
            width: 150px;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
            filter: brightness(1.1);
        }

        .footer-logo:hover {
            transform: scale(1.05);
        }

        @media (max-width: 1024px) {
            .header { padding: 20px 40px; }
            .footer { padding: 50px 80px; }
            .footer-logo { width: 130px; }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                padding: 15px 20px;
            }
            .brand-logo { width: 120px; }
            .header-right {
                width: 100%;
                justify-content: space-between;
                gap: 20px;
            }
            .nav { gap: 20px; }
            .footer {
                flex-direction: column;
                gap: 40px;
                padding: 40px 20px;
                text-align: center;
            }
            .footer-left { align-items: center; }
            .footer-right { align-items: center; justify-content: center; }
            .footer-logo { width: 120px; }
        }

        @media (max-width: 480px) {
            .header-right { flex-direction: column; gap: 15px; }
            .nav { gap: 15px; }
            .nav-link { font-size: 18px; }
            .btn-header { padding: 8px 20px; font-size: 16px; }
            .footer { padding: 30px 20px; gap: 30px; }
            .footer-link { font-size: 20px; }
            .footer-logo { width: 100px; }
        }

        /* Status badge */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-pending { background-color: #FEF3C7; color: #92400E; }
        .status-paid { background-color: #D1FAE5; color: #065F46; }
        .status-processed { background-color: #DBEAFE; color: #1E40AF; }
        .status-shipped { background-color: #E0E7FF; color: #3730A3; }
        .status-completed { background-color: #F3E8FF; color: #6B21A8; }
        
        /* Feedback Section Styles */
        .feedback-section {
            background: linear-gradient(135deg, #FFF8EE, #FFF0E0);
            border: 2px solid #758E27;
            border-radius: 2rem;
            padding: 2rem;
            margin-top: 3rem;
            transition: all 0.3s ease;
        }
        
        .rating-star {
            transition: all 0.2s ease;
            cursor: pointer;
            font-size: 3rem;
        }
        
        .rating-star:hover {
            transform: scale(1.2);
        }
        
        .feedback-tag {
            background: white;
            border: 2px solid #758E27;
            border-radius: 2rem;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Bubblegum Sans', cursive;
        }
        
        .feedback-tag:hover {
            background: #758E27;
            color: white;
            transform: translateY(-2px);
        }
        
        .feedback-tag.selected {
            background: #758E27;
            color: white;
        }
        
        .review-badge {
            display: inline-block;
            background: #758E27;
            color: white;
            border-radius: 2rem;
            padding: 0.25rem 1rem;
            font-size: 0.9rem;
            margin: 0.25rem;
        }
        
        .animate-pulse-slow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- 🔥 HIDDEN DATA UNTUK USER INFO -->
    <div data-user-name="{{ auth()->check() ? auth()->user()->name : 'Guest' }}" 
         data-user-email="{{ auth()->check() ? auth()->user()->email : '' }}"
         style="display: none;"></div>

    <!-- HEADER -->
    <header class="header">
        <div class="logo-container">
            <a href="{{ route('home') }}" class="logo-link">
                <img src="{{ asset('assets/images/logobrand.png') }}" alt="Pempek Bunda 75 Logo" class="brand-logo">
            </a>
        </div>

        <div class="header-right">
            <nav class="nav">
                <a href="{{ route('home') }}" class="nav-link">home</a>
                <a href="{{ route('order.index') }}" class="nav-link">produk</a>
                <a href="{{ route('order.my-orders') }}" class="nav-link">cek pesanan</a>
            </nav>
            <a href="{{ route('order.index') }}" class="btn-header">order</a>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow" style="margin-top: 120px; padding: 40px 20px; max-width: 1400px; margin-left: auto; margin-right: auto; width: 100%;">

        @if(isset($order) && $order)
            @php
                // CEK APAKAH ORDER ADALAH OBJECT ATAU ARRAY
                $isObject = is_object($order);
                
                // AMBIL DATA BERDASARKAN TIPE
                $kodePesanan = $isObject ? $order->kode_pesanan : $order['kode_pesanan'];
                $customer = $isObject ? $order->customer : $order['customer'];
                $delivery = $isObject ? $order->delivery : $order['delivery'];
                $payment = $isObject ? $order->payment : $order['payment'];
                $items = $isObject ? $order->items : $order['items'];
                $subtotal = $isObject ? $order->subtotal : $order['subtotal'];
                $total = $isObject ? $order->total : $order['total'];
                $statusPesanan = $isObject ? $order->status_pesanan : $order['status_pesanan'];
                $statusPembayaran = $isObject ? $order->status_pembayaran : $order['status_pembayaran'];
                $tanggalPesanan = $isObject ? $order->tanggal_pesanan : \Carbon\Carbon::parse($order['tanggal_pesanan']);
                $batasPembayaran = $isObject ? $order->batas_pembayaran : \Carbon\Carbon::parse($order['batas_pembayaran']);
                
                // Status mapping
                $stages = ['Menunggu', 'Dibayar', 'Diproses', 'Dikirim', 'Selesai'];
                $statusMap = [
                    'pending' => 0,
                    'paid' => 1,
                    'processed' => 2,
                    'shipped' => 3,
                    'completed' => 4
                ];
                $currentStage = $statusMap[$statusPesanan] ?? 0;
                
                // Extract e-wallet dari nama pengirim
                $ewallet = 'QRIS';
                $namaPengirim = $payment['nama_pengirim'] ?? '-';
                if (strpos(strtoupper($namaPengirim), 'OVO') !== false) $ewallet = 'OVO';
                else if (strpos(strtoupper($namaPengirim), 'GOPAY') !== false) $ewallet = 'GoPay';
                else if (strpos(strtoupper($namaPengirim), 'DANA') !== false) $ewallet = 'DANA';
                else if (strpos(strtoupper($namaPengirim), 'SHOPEE') !== false) $ewallet = 'ShopeePay';
                else if (strpos(strtoupper($namaPengirim), 'LINKAJA') !== false) $ewallet = 'LinkAja';
                
                // Status class
                $statusClass = '';
                switch($statusPesanan) {
                    case 'pending': $statusClass = 'status-pending'; break;
                    case 'paid': $statusClass = 'status-paid'; break;
                    case 'processed': $statusClass = 'status-processed'; break;
                    case 'shipped': $statusClass = 'status-shipped'; break;
                    case 'completed': $statusClass = 'status-completed'; break;
                }
            @endphp
            
            <!-- LAYOUT KIRI-KANAN DENGAN GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in">
                
                <!-- KOLOM KIRI: TERIMA KASIH & STATUS -->
                <div class="space-y-6">
                    <!-- Header Sukses dengan FONT RASCAL -->
                    <div class="bg-white p-8 rounded-[2rem] border-2 border-[#758E27] shadow-lg">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check text-white text-3xl"></i>
                            </div>
                            
                            <!-- TERIMA KASIH dengan FONT RASCAL -->
                            <h2 class="text-5xl md:text-6xl font-rascal text-[#7c2d12] mb-2 tracking-tight" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Terima Kasih</h2>
                            
                            <p class="text-gray-500 mb-4 text-lg" style="font-family: 'Bubblegum Sans', cursive;">Pesananmu berhasil dibuat dengan ID:</p>
                            <div class="inline-block bg-[#FFF8EE] px-6 py-3 rounded-full border-2 border-[#E8DCC4]">
                                <span class="text-[#C6584F] font-mono font-bold text-xl tracking-wider">
                                    {{ $kodePesanan }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Status Stages -->
                    <div class="bg-white p-8 rounded-[2rem] border-2 border-[#758E27] shadow-lg">
                        <h3 class="text-2xl font-bold text-[#758E27] mb-6 text-center" style="font-family: 'Bubblegum Sans', cursive;">Progress Pesanan</h3>
                        
                        <div class="relative mb-8 px-4">
                            <!-- Progress Bar Background -->
                            <div class="absolute top-5 left-0 w-full h-1 bg-gray-200 rounded-full"></div>
                            
                            <!-- Progress Bar Active -->
                            <div class="absolute top-5 left-0 h-1 bg-[#758E27] rounded-full transition-all duration-500" 
                                 style="width: {{ ($currentStage / 4) * 100 }}%;"></div>

                            <!-- Stages -->
                            <div class="relative flex justify-between">
                                @foreach($stages as $index => $stage)
                                    @php
                                        $isActive = $index <= $currentStage;
                                        $isCurrent = $index === $currentStage;
                                    @endphp
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all duration-300 {{ $isActive ? 'bg-[#758E27] text-white shadow-lg scale-110' : 'bg-gray-200 text-gray-400' }} {{ $isCurrent ? 'ring-4 ring-[#758E27]/20' : '' }}">
                                            @if($isActive && $index < $currentStage)
                                                <i class="fas fa-check"></i>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </div>
                                        <span class="mt-2 text-sm font-bold tracking-wider {{ $isActive ? 'text-[#758E27]' : 'text-gray-400' }}" style="font-family: 'Bubblegum Sans', cursive;">
                                            {{ $stage }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Batas Waktu Pembayaran -->
                        <div class="bg-[#FFF8EE] p-6 rounded-2xl border-2 border-[#E8DCC4]">
                            <div class="flex items-center justify-center gap-2 text-[#5C3D2E] mb-3">
                                <i class="fas fa-clock"></i>
                                <span class="font-bold" style="font-family: 'Bubblegum Sans', cursive;">Batas Waktu Konfirmasi Pembayaran:</span>
                            </div>
                            
                            <div class="countdown text-4xl font-bold text-[#C6584F] text-center mb-2" 
                                 data-deadline="{{ $batasPembayaran->format('Y-m-d H:i:s') }}">
                                {{ $batasPembayaran->diffForHumans(['parts' => 2]) }}
                            </div>
                            
                            <p class="text-sm text-gray-500 text-center italic" style="font-family: 'Bubblegum Sans', cursive;">
                                Segera lakukan pembayaran sebelum {{ $batasPembayaran->format('H:i') }} WIB
                            </p>
                        </div>
                    </div>

                    <!-- Tombol WhatsApp -->
                    @php
                        $whatsappMessage = "Halo Admin Pempek Bunda 75,\n\n";
                        $whatsappMessage .= "Saya ingin mengonfirmasi pembayaran untuk pesanan dengan detail berikut:\n\n";
                        $whatsappMessage .= "- ID Pesanan: " . $kodePesanan . "\n";
                        $whatsappMessage .= "- Nama Pemesan: " . ($customer['nama'] ?? 'Customer') . "\n";
                        $whatsappMessage .= "- Metode Pembayaran: QRIS (" . $ewallet . ")\n";
                        $whatsappMessage .= "- Total Pembayaran: Rp" . number_format($total, 0, ',', '.') . "\n\n";
                        $whatsappMessage .= "Bukti pembayaran sudah saya lampirkan.\n";
                        $whatsappMessage .= "Terima kasih.";
                        
                        $whatsappUrl = "https://wa.me/6282183139218?text=" . urlencode($whatsappMessage);
                    @endphp

                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                       class="block w-full bg-[#25D366] text-white py-4 rounded-xl font-bold text-center hover:bg-[#20ba5a] transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                       style="font-family: 'Bubblegum Sans', cursive; font-size: 1.25rem;">
                        <i class="fab fa-whatsapp mr-2"></i>
                        KIRIM BUKTI KE WHATSAPP
                    </a>
                    
                    <p class="text-xs text-center text-gray-500" style="font-family: 'Bubblegum Sans', cursive;">
                        <i class="fas fa-image mr-1"></i> Jangan lupa lampirkan screenshot bukti pembayaran
                    </p>
                </div>

                <!-- KOLOM KANAN: DETAIL PESANAN -->
                <div class="space-y-6">
                    <!-- Detail Pesanan -->
                    <div class="bg-white p-6 rounded-[2rem] border-2 border-[#758E27] shadow-lg">
                        <h3 class="text-2xl font-bold text-[#C6584F] mb-4 flex items-center gap-2" style="font-family: 'Bubblegum Sans', cursive;">
                            <i class="fas fa-file-invoice"></i>
                            Detail Pesanan
                        </h3>

                        <!-- Info Umum -->
                        <div class="grid grid-cols-2 gap-4 mb-6 p-4 bg-[#FFF8EE] rounded-xl" style="font-family: 'Bubblegum Sans', cursive;">
                            <div>
                                <p class="text-xs text-gray-500 uppercase">ID Pesanan</p>
                                <p class="font-mono font-bold text-[#5C3D2E]">{{ $kodePesanan }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Tanggal</p>
                                <p class="font-bold text-[#5C3D2E]">{{ $tanggalPesanan->format('d M Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Status</p>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ strtoupper(str_replace('_', ' ', $statusPesanan)) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Metode Bayar</p>
                                <p class="font-bold text-[#5C3D2E]">QRIS ({{ $ewallet }})</p>
                            </div>
                        </div>

                        <!-- Data Pengirim -->
                        <div class="mb-6 p-4 bg-[#FFF8EE] rounded-xl" style="font-family: 'Bubblegum Sans', cursive;">
                            <p class="font-bold text-[#5C3D2E] mb-3 text-base flex items-center gap-2">
                                <i class="fas fa-user"></i> Data Pengirim
                            </p>
                            <div class="grid grid-cols-2 gap-3 text-sm">
                                <div>
                                    <p class="text-gray-500 text-xs">Nama</p>
                                    <p class="font-bold">{{ $customer['nama'] ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs">Email</p>
                                    <p class="font-bold">{{ $customer['email'] ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs">WhatsApp</p>
                                    <p class="font-bold">{{ $customer['telepon'] ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs">Pengiriman</p>
                                    <p class="font-bold">{{ ($delivery['metode'] ?? '') == 'pickup' ? 'Ambil Sendiri' : 'GoSend' }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-500 text-xs">Alamat</p>
                                    <p class="font-bold">{{ $customer['alamat'] ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Daftar Produk -->
                        <div class="mb-6">
                            <h4 class="font-bold text-[#5C3D2E] mb-3 text-lg flex items-center gap-2" style="font-family: 'Bubblegum Sans', cursive;">
                                <i class="fas fa-shopping-bag"></i> Pesanan Anda
                            </h4>
                            <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
                                @foreach($items as $item)
                                <div class="flex justify-between items-center p-3 bg-[#FFF8EE] rounded-xl" style="font-family: 'Bubblegum Sans', cursive;">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                            <img src="{{ $item['image'] ?? asset('assets/images/Pempek.png') }}" 
                                                 alt="{{ $item['name'] }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-bold text-[#5C3D2E]">{{ $item['name'] }}</p>
                                            <p class="text-sm text-gray-500">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <p class="font-bold text-[#C6584F]">
                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </p>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="border-t border-[#E8DCC4] pt-4" style="font-family: 'Bubblegum Sans', cursive;">
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Subtotal</span>
                                    <span class="font-bold text-[#5C3D2E]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Ongkos Kirim</span>
                                    <span class="font-bold text-[#5C3D2E]">
                                        @if($delivery['shipping_cost'] == 0)
                                            GRATIS
                                        @else
                                            Rp {{ number_format($delivery['shipping_cost'], 0, ',', '.') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between text-lg font-bold pt-2 border-t border-[#E8DCC4]">
                                    <span class="text-[#5C3D2E]">Total</span>
                                    <span class="text-[#C6584F]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 🔥 INFO TEKS - TANPA KOTAK, HANYA TEKS -->
                    <div class="text-center mt-4">
                        <p class="text-xs text-gray-400 italic" style="font-family: 'Bubblegum Sans', cursive;">
                            <i class="fas fa-info-circle mr-1 text-[#758E27]"></i>
                            Link invoice ini unik dan hanya milikmu. Simpan halaman ini untuk memantau status pesananmu secara real-time.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 🔥 FEEDBACK SECTION DENGAN ALPINE.JS - VERSI TERBARU DENGAN API CALL -->
            <div class="feedback-section w-full mt-12" 
                 x-data="feedbackSystem('{{ $kodePesanan }}', {
                    userName: '{{ auth()->check() ? auth()->user()->name : 'Guest' }}',
                    userEmail: '{{ auth()->check() ? auth()->user()->email : '' }}'
                 })" 
                 x-init="init()"
                 x-cloak>
                
                <!-- SEBELUM SUBMIT - Tampilan Form Review -->
                <div x-show="!submitted" x-transition:enter="animate-fade-in">
                    <div class="text-center mb-8">
                        <!-- TITLE BESAR dengan FONT RASCAL - GIMANA PENGALAMANMU? -->
                        <h3 class="text-6xl md:text-7xl font-rascal text-[#7c2d12] mb-4 tracking-tight" 
                            style="text-shadow: 3px 3px 6px rgba(0,0,0,0.1);">
                            Gimana Pengalamanmu?
                        </h3>
                        <p class="text-xl text-[#5C3D2E] opacity-80" style="font-family: 'Bubblegum Sans', cursive;">
                            Kasih tau pendapatmu tentang pesanan ini, yuk!
                        </p>
                    </div>

                    <!-- Rating Bintang dengan Alpine -->
                    <div class="flex justify-center gap-3 mb-8">
                        <template x-for="star in 5" :key="star">
                            <button @click="setRating(star)" 
                                    class="rating-star focus:outline-none"
                                    :class="{ 'text-[#FFB800]': star <= rating, 'text-gray-300': star > rating }">
                                <i :class="star <= rating ? 'fas fa-star' : 'far fa-star'"></i>
                            </button>
                        </template>
                    </div>

                    <!-- Feedback Tags (Multi-select) -->
                    <div class="flex flex-wrap justify-center gap-3 mb-8">
                        <template x-for="tag in availableTags" :key="tag">
                            <button @click="toggleTag(tag)" 
                                    class="feedback-tag"
                                    :class="{ 'selected': selectedTags.includes(tag) }">
                                <span x-text="tag"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Text Review -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#5C3D2E] mb-2" style="font-family: 'Bubblegum Sans', cursive;">
                            Tulis Review Disini Ya!
                        </label>
                        <textarea x-model="reviewText" 
                                  rows="4" 
                                  class="w-full px-4 py-3 bg-white border-2 border-[#E8DCC4] rounded-xl focus:border-[#758E27] focus:outline-none transition-all"
                                  placeholder="Ceritakan pengalamanmu..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button @click="submitReview()" 
                                class="bg-[#758E27] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#5a7520] transition-all transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed"
                                :disabled="isSubmitting">
                            <span x-show="!isSubmitting">
                                Kirim Review
                                <i class="fas fa-paper-plane ml-2"></i>
                            </span>
                            <span x-show="isSubmitting">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Mengirim...
                            </span>
                        </button>
                    </div>
                </div>

                <!-- SETELAH SUBMIT - Tampilan Review Kamu -->
                <div x-show="submitted" x-transition:enter="animate-fade-in">
                    <div class="text-center mb-8">
                        <!-- TITLE BESAR "Review Kamu" dengan FONT RASCAL -->
                        <h3 class="text-6xl md:text-7xl font-rascal text-[#7c2d12] mb-4 tracking-tight" 
                            style="text-shadow: 3px 3px 6px rgba(0,0,0,0.1);">
                            Review Kamu
                        </h3>
                        <p class="text-xl text-[#5C3D2E] opacity-80" style="font-family: 'Bubblegum Sans', cursive;">
                            Terima kasih sudah memberikan feedback!
                        </p>
                    </div>

                    <!-- Tampilkan Rating yang Dikirim -->
                    <div class="flex justify-center gap-3 mb-6">
                        <template x-for="star in 5" :key="star">
                            <span class="text-3xl" :class="{ 'text-[#FFB800]': star <= submittedRating, 'text-gray-300': star > submittedRating }">
                                <i :class="star <= submittedRating ? 'fas fa-star' : 'far fa-star'"></i>
                            </span>
                        </template>
                    </div>

                    <!-- Tampilkan Tags yang Dipilih -->
                    <div class="flex flex-wrap justify-center gap-2 mb-6" x-show="submittedTags.length > 0">
                        <template x-for="tag in submittedTags" :key="tag">
                            <span class="review-badge" x-text="tag"></span>
                        </template>
                    </div>

                    <!-- Tampilkan Review Text -->
                    <div class="bg-white p-6 rounded-xl border-2 border-[#758E27] mb-6" x-show="submittedReviewText">
                        <p class="text-lg italic text-[#5C3D2E]" style="font-family: 'Coming Soon', cursive;" x-text="'\"' + submittedReviewText + '\"'"></p>
                    </div>

                    <!-- Terima Kasih Message -->
                    <div class="text-center text-[#758E27] mt-4 animate-pulse-slow">
                        <i class="fas fa-heart text-2xl"></i>
                        <p class="text-sm mt-2" style="font-family: 'Bubblegum Sans', cursive;">Reviewmu sangat berarti untuk kami!</p>
                    </div>
                </div>
            </div>

        @else
            <!-- Order Not Found -->
            <div class="max-w-3xl mx-auto bg-white p-8 rounded-[2rem] border border-[#E8DCC4] shadow-sm text-center">
                <div class="text-[#C6584F] mb-6">
                    <i class="fas fa-exclamation-triangle text-6xl"></i>
                </div>
                <h2 class="text-3xl font-rascal text-[#7c2d12] mb-4">Pesanan Tidak Ditemukan</h2>
                <p class="text-gray-500 mb-8" style="font-family: 'Bubblegum Sans', cursive;">ID Pesanan: {{ request()->route('invoice') }}</p>
                <a href="{{ route('home') }}" class="inline-block bg-[#C6584F] text-white px-8 py-3 rounded-full font-bold hover:bg-[#b04d45] transition-all" style="font-family: 'Bubblegum Sans', cursive;">
                    Kembali ke Beranda
                </a>
            </div>
        @endif

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-left">
            <a href="{{ route('order.index') }}" class="footer-link">order</a>
            <a href="{{ route('home') }}" class="footer-link">home</a>
            <a href="{{ route('home') }}#produk" class="footer-link">produk</a>
            <a href="{{ route('order.my-orders') }}" class="footer-link">cek pesanan</a>
        </div>

        <div class="footer-right">
            <a href="{{ route('home') }}" class="footer-logo-link">
                <img src="{{ asset('assets/images/logobrand.png') }}" alt="Pempek Bunda 75 Logo" class="footer-logo">
            </a>
        </div>
    </footer>

    <!-- Alpine.js Component - VERSI TERBARU DENGAN API CALL -->
    <script>
        function feedbackSystem(orderCode, userInfo) {
            return {
                // State
                rating: 0,
                selectedTags: [],
                reviewText: '',
                isSubmitting: false,
                submitted: false,
                
                // Data yang akan disimpan setelah submit
                submittedRating: 0,
                submittedTags: [],
                submittedReviewText: '',
                
                // User info
                userName: userInfo.userName || 'Guest',
                userEmail: userInfo.userEmail || '',
                
                // Available tags
                availableTags: [
                    '🍜 Pempeknya enak',
                    '🚚 Kilat pengirimannya',
                    '😄 Adminnya ramah',
                    '💰 Harga worth it',
                    '📦 Packing rapi',
                    '⭐ Porsi pas',
                    '🔥 Sambelnya nampol',
                    '👍 Tekstur lembut',
                    '⏱️ Cepet dateng',
                    '🥡 Kuah cuko mantap'
                ],
                
                // Set rating
                setRating(val) {
                    this.rating = val;
                },
                
                // Toggle tag selection
                toggleTag(tag) {
                    if (this.selectedTags.includes(tag)) {
                        this.selectedTags = this.selectedTags.filter(t => t !== tag);
                    } else {
                        this.selectedTags.push(tag);
                    }
                },
                
                // 🔥 FIXED: SUBMIT REVIEW - Review Text tersimpan dengan benar
                submitReview() {
                    if (this.rating === 0) {
                        alert('Yuk kasih bintang dulu! ⭐');
                        return;
                    }
                    
                    this.isSubmitting = true;
                    
                    const reviewData = {
                        name: this.userName,
                        email: this.userEmail,
                        rating: this.rating,
                        tags: this.selectedTags,
                        review: this.reviewText,
                        order_code: orderCode
                    };
                    
                    console.log('📤 Sending review:', reviewData);
                    
                    // 🔥 PASTIKAN DATA DISIMPAN KE LOCALSTORAGE DULU
                    const reviewToSave = {
                        rating: this.rating,
                        tags: this.selectedTags,
                        review: this.reviewText,
                        timestamp: new Date().toISOString()
                    };
                    
                    localStorage.setItem(`review_${orderCode}`, JSON.stringify(reviewToSave));
                    
                    // Kirim ke API
                    fetch('/api/feedback', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(reviewData)
                    })
                    .then(response => {
                        console.log('📥 Response status:', response.status);
                        return response.json().catch(() => ({}));
                    })
                    .then(data => {
                        console.log('✅ Response:', data);
                        
                        // 🔥 UPDATE STATE DENGAN DATA YANG SAMA
                        this.submittedRating = this.rating;
                        this.submittedTags = [...this.selectedTags];
                        this.submittedReviewText = this.reviewText;
                        
                        this.isSubmitting = false;
                        this.submitted = true;
                        
                        alert('✅ Review berhasil dikirim! Terima kasih.');
                    })
                    .catch(error => {
                        console.error('❌ Error:', error);
                        
                        // 🔥 TETAP UPDATE STATE MESKI API GAGAL
                        this.submittedRating = this.rating;
                        this.submittedTags = [...this.selectedTags];
                        this.submittedReviewText = this.reviewText;
                        
                        this.isSubmitting = false;
                        this.submitted = true;
                        
                        alert('✅ Review berhasil disimpan! Terima kasih.');
                    });
                },
                
                // 🔥 FIXED: INIT - Ambil review text dari localStorage dengan benar
                init() {
                    const savedReview = localStorage.getItem(`review_${orderCode}`);
                    if (savedReview) {
                        try {
                            const review = JSON.parse(savedReview);
                            console.log('📂 Loaded from localStorage:', review);
                            
                            this.submitted = true;
                            this.submittedRating = review.rating || 0;
                            this.submittedTags = Array.isArray(review.tags) ? review.tags : [];
                            this.submittedReviewText = review.review || ''; // 🔥 AMBIL REVIEW TEXT
                            
                            // 🔥 DEBUG: Pastikan review text terbaca
                            console.log('📝 Review text loaded:', this.submittedReviewText);
                        } catch (e) {
                            console.error('Error parsing localStorage:', e);
                        }
                    }
                }
            }
        }
    </script>

    <!-- Countdown Timer Script -->
    <script>
        function updateCountdown() {
            const countdownEl = document.querySelector('.countdown');
            if (!countdownEl) return;
            
            const deadline = countdownEl.dataset.deadline;
            if (!deadline) return;
            
            const deadlineTime = new Date(deadline).getTime();
            const now = new Date().getTime();
            const distance = deadlineTime - now;
            
            if (distance < 0) {
                countdownEl.innerHTML = '00:00:00';
                return;
            }
            
            const hours = Math.floor(distance / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            countdownEl.innerHTML = 
                (hours < 10 ? '0' + hours : hours) + ':' +
                (minutes < 10 ? '0' + minutes : minutes) + ':' +
                (seconds < 10 ? '0' + seconds : seconds);
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>

    <!-- 🔥 DEBUG SCRIPT UNTUK CEK LOCALSTORAGE -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah ada review yang tersimpan
            const orderCode = '{{ $kodePesanan ?? '' }}';
            if (orderCode) {
                const saved = localStorage.getItem(`review_${orderCode}`);
                console.log('🔍 Initial check for order', orderCode, ':', saved);
                
                // Kalau ada, trigger Alpine untuk update
                if (saved) {
                    setTimeout(() => {
                        window.dispatchEvent(new CustomEvent('review-loaded', { detail: JSON.parse(saved) }));
                    }, 500);
                }
            }
        });
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

</body>
</html>