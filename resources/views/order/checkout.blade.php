<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - PempekBunda 75</title>

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
  <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  
  <!-- Leaflet CSS & JS (OpenStreetMap - 100% GRATIS, TIDAK PERLU API KEY!) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
        crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
          integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
          crossorigin=""></script>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Alpine.js - Load AFTER Leaflet -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  
  <style>
    html {
      scroll-behavior: smooth;
      scroll-padding-top: 100px;
    }
    
    body {
      font-family: 'Reenie Beanie', cursive;
      background-color: #ffffff;
      color: #000;
      margin: 0;
      padding: 0;
    }
    
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
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 768px) {
      .header { flex-direction: row !important; justify-content: space-between; align-items: center; padding: 12px 20px; }
      .footer { flex-direction: row !important; justify-content: space-between; align-items: center; padding: 24px 20px; }
      .footer-left { align-items: flex-start; gap: 8px; }
      .footer-right { margin-left: 0; }
      .footer-logo { width: 80px; }
    }

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

    /* ===== STEPPER ===== */
    .stepper {
      display: flex;
      justify-content: space-between;
      margin-bottom: 40px;
      position: relative;
    }

    .stepper::before {
      content: '';
      position: absolute;
      top: 20px;
      left: 0;
      right: 0;
      height: 2px;
      background: #e0e0e0;
      z-index: 1;
    }

    .stepper-item {
      position: relative;
      z-index: 2;
      text-align: center;
      flex: 1;
    }

    .stepper-number {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #e0e0e0;
      color: #666;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 10px;
      font-weight: bold;
      border: 2px solid white;
    }

    .stepper-item.active .stepper-number {
      background-color: #6B8E23;
      color: white;
    }

    .stepper-item.completed .stepper-number {
      background-color: #BC5A45;
      color: white;
    }

    .stepper-label {
      font-size: 14px;
      color: #666;
      font-family: 'Fredoka', sans-serif;
    }

    .stepper-item.active .stepper-label {
      color: #6B8E23;
      font-weight: bold;
    }

    /* ===== PAYMENT METHODS ===== */
    .payment-method {
      border: 2px solid #e0e0e0;
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 15px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .payment-method:hover {
      border-color: #6B8E23;
    }

    .payment-method.selected {
      border-color: #6B8E23;
      background-color: rgba(107, 142, 35, 0.05);
    }

    .payment-method input[type="radio"] {
      accent-color: #6B8E23;
    }

    /* ===== DELIVERY OPTIONS ===== */
    .delivery-option {
      border: 2px solid #e0e0e0;
      border-radius: 12px;
      padding: 15px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .delivery-option:hover {
      border-color: #6B8E23;
    }

    .delivery-option.selected {
      border-color: #6B8E23;
      background-color: rgba(107, 142, 35, 0.05);
    }

    /* ===== MAP CONTAINER ===== */
    .map-container {
      width: 100%;
      height: 300px;
      border-radius: 16px;
      overflow: hidden;
      border: 4px solid #6B8E23;
      margin-top: 20px;
    }

    .map-container iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    /* ===== MAP MODAL ===== */
    [x-cloak] {
      display: none !important;
    }

    @keyframes bounce {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    .animate-bounce {
      animation: bounce 1s infinite;
    }

    /* Map Modal Overlay */
    .map-modal-overlay {
      backdrop-filter: blur(5px);
    }

    /* Smooth transitions */
    .transition-all {
      transition: all 0.3s ease;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col" x-data="checkoutSystem()" x-init="initCheckout()">

  <!-- HEADER -->
  <header class="header">
    <div class="logo-container">
      <a href="{{ route('home') }}" class="logo-link">
        <img src="{{ asset('assets/images/logobrand.png') }}" alt="PempekBunda 75 Logo" class="brand-logo">
      </a>
    </div>
    <!-- Desktop Nav -->
    <div class="header-right" id="desktop-nav-checkout">
      <nav class="nav">
        <a href="{{ route('home') }}" class="nav-link">home</a>
        <a href="{{ route('order.index') }}" class="nav-link">produk</a>
        <a href="{{ route('order.my-orders') }}" class="nav-link">cek pesanan</a>
      </nav>
      <a href="{{ route('order.index') }}" class="btn-header">order</a>
    </div>
    <!-- Hamburger -->
    <button id="hamburger-checkout" aria-label="Buka menu" style="display:none; background:none; border:none; cursor:pointer; padding:8px;">
      <svg id="icon-open-checkout" width="28" height="28" fill="none" stroke="#7c2d12" stroke-width="2.5" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      <svg id="icon-close-checkout" width="28" height="28" fill="none" stroke="#7c2d12" stroke-width="2.5" viewBox="0 0 24 24" style="display:none;"><line x1="4" y1="4" x2="20" y2="20"/><line x1="20" y1="4" x2="4" y2="20"/></svg>
    </button>
  </header>

  <!-- Mobile Menu -->
  <div id="mobile-nav-checkout" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(255,255,255,0.98); z-index:999998; flex-direction:column; align-items:center; justify-content:center; gap:32px;">
    <a href="{{ route('home') }}" class="nav-link" style="font-size:2rem;" onclick="closeMobileCheckout()">home</a>
    <a href="{{ route('order.index') }}" class="nav-link" style="font-size:2rem;" onclick="closeMobileCheckout()">produk</a>
    <a href="{{ route('order.my-orders') }}" class="nav-link" style="font-size:2rem;" onclick="closeMobileCheckout()">cek pesanan</a>
    <a href="{{ route('order.index') }}" class="btn-header" style="font-size:1.5rem; margin-top:8px;" onclick="closeMobileCheckout()">order</a>
  </div>

  <style>
    @media (max-width: 768px) {
      #desktop-nav-checkout { display: none !important; }
      #hamburger-checkout { display: block !important; }
    }
  </style>
  <script>
    document.getElementById('hamburger-checkout').addEventListener('click', function() {
      const nav = document.getElementById('mobile-nav-checkout');
      const isOpen = nav.style.display === 'flex';
      nav.style.display = isOpen ? 'none' : 'flex';
      document.getElementById('icon-open-checkout').style.display = isOpen ? 'block' : 'none';
      document.getElementById('icon-close-checkout').style.display = isOpen ? 'none' : 'block';
    });
    function closeMobileCheckout() {
      document.getElementById('mobile-nav-checkout').style.display = 'none';
      document.getElementById('icon-open-checkout').style.display = 'block';
      document.getElementById('icon-close-checkout').style.display = 'none';
    }
  </script>

  <!-- MAIN CONTENT -->
  <main class="flex-grow" style="margin-top: 80px; padding: 40px 16px; max-width: 1200px; margin-left: auto; margin-right: auto; width: 100%;">

    <h1 class="text-5xl md:text-6xl font-rascal text-center mb-8" style="color: #7c2d12;">Checkout</h1>

    <!-- STEPPER -->
    <div class="stepper mb-12">
      <div class="stepper-item" :class="{ 'active': step >= 1, 'completed': step > 1 }">
        <div class="stepper-number">1</div>
        <div class="stepper-label">Detail Pesanan</div>
      </div>
      <div class="stepper-item" :class="{ 'active': step >= 2, 'completed': step > 2 }">
        <div class="stepper-number">2</div>
        <div class="stepper-label">Pembayaran</div>
      </div>
      <div class="stepper-item" :class="{ 'active': step >= 3, 'completed': step > 3 }">
        <div class="stepper-number">3</div>
        <div class="stepper-label">Konfirmasi</div>
      </div>
    </div>

    <!-- STEP 1: DETAIL PESANAN -->
    <div x-show="step === 1" x-cloak>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Customer Info -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-3xl shadow-lg p-6 mb-6 border-2 border-[#6B8E23]">
            <h2 class="text-3xl font-bubble text-[#6B8E23] mb-4">Informasi Pemesan</h2>
            
            <!-- Nama (auto dari user) -->
            <div class="mb-4">
              <label class="block text-lg font-fredoka mb-2">Nama Lengkap</label>
              <input type="text" x-model="customer.name" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#6B8E23] font-fredoka text-lg" readonly>
            </div>
            
            <!-- Email (auto dari user) -->
            <div class="mb-4">
              <label class="block text-lg font-fredoka mb-2">Email</label>
              <input type="email" x-model="customer.email" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#6B8E23] font-fredoka text-lg" readonly>
            </div>
            
            <!-- Nomor WhatsApp -->
            <div class="mb-4">
              <label class="block text-lg font-fredoka mb-2">Nomor WhatsApp <span class="text-red-500">*</span></label>
              <input type="tel" x-model="customer.phone" placeholder="081234567890" class="w-full px-4 py-3 border-2 border-gray-300 rounded-full focus:border-[#6B8E23] font-fredoka text-lg" required>
            </div>
          </div>

          <!-- Delivery Options -->
          <div class="bg-white rounded-3xl shadow-lg p-6 mb-6 border-2 border-[#6B8E23]">
            <h2 class="text-3xl font-bubble text-[#6B8E23] mb-4">Metode Pengiriman</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="delivery-option" :class="{ 'selected': delivery.method === 'pickup' }" @click="delivery.method = 'pickup'">
                <div class="flex items-center gap-3">
                  <input type="radio" name="delivery" value="pickup" x-model="delivery.method" class="w-5 h-5">
                  <div>
                    <h3 class="text-xl font-bubble text-[#6B8E23]">Ambil Sendiri</h3>
                    <p class="text-sm font-fredoka">Gratis • Ambil di toko</p>
                  </div>
                </div>
              </div>

              <div class="delivery-option" :class="{ 'selected': delivery.method === 'delivery' }" @click="delivery.method = 'delivery'">
                <div class="flex items-center gap-3">
                  <input type="radio" name="delivery" value="delivery" x-model="delivery.method" class="w-5 h-5">
                  <div>
                    <h3 class="text-xl font-bubble text-[#6B8E23]">Diantar (GoSend)</h3>
                    <p class="text-sm font-fredoka">Rp 15.000 • Gojek/Grab</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Alamat Spesifik (untuk delivery) -->
            <div x-show="delivery.method === 'delivery'" x-cloak class="mt-6">
              <h3 class="text-2xl font-bubble text-[#6B8E23] mb-4">📍 Pilih Lokasi Pengiriman</h3>
              
              <!-- Google Maps Embedded -->
              <div class="mb-4">
                <label class="block text-lg font-fredoka mb-2">
                  <i class="fas fa-map-marked-alt mr-2"></i>
                  Geser pin merah atau klik peta untuk menentukan lokasi Anda <span class="text-red-500">*</span>
                </label>
                <div id="embedded-map" class="w-full h-[500px] rounded-2xl border-4 border-[#6B8E23] shadow-lg relative">
                  <!-- Loading Overlay -->
                  <div x-show="mapLoading" class="absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center z-10 rounded-2xl">
                    <div class="text-center">
                      <i class="fas fa-spinner fa-spin text-4xl text-[#6B8E23] mb-2"></i>
                      <p class="font-fredoka text-lg">Memuat peta...</p>
                    </div>
                  </div>
                </div>
                <div class="mt-2 flex items-center gap-4 text-sm font-fredoka">
                  <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                    <span>Lokasi Toko (Fixed)</span>
                  </div>
                  <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-red-500 rounded-full"></div>
                    <span>Lokasi Anda (Geser untuk pindah)</span>
                  </div>
                </div>
              </div>
              
              <!-- Jarak & Ongkir Display -->
              <div x-show="pengiriman.jarak_km > 0" class="mb-4 bg-blue-50 border-2 border-blue-300 rounded-xl p-4">
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-fredoka font-semibold mb-1 text-blue-700">
                      <i class="fas fa-route mr-1"></i> Jarak dari Toko
                    </label>
                    <p class="text-2xl font-bubble text-blue-900" x-text="pengiriman.jarak_km.toFixed(2) + ' km'"></p>
                  </div>
                  <div>
                    <label class="block text-sm font-fredoka font-semibold mb-1 text-blue-700">
                      <i class="fas fa-money-bill-wave mr-1"></i> Ongkos Kirim
                    </label>
                    <p class="text-2xl font-bubble text-blue-900" x-text="'Rp ' + pengiriman.ongkir.toLocaleString('id-ID')"></p>
                  </div>
                </div>
                <p class="text-xs font-fredoka text-gray-600 mt-2">
                  <i class="fas fa-info-circle mr-1"></i>
                  Perhitungan: <span x-text="pengiriman.jarak_km.toFixed(2)"></span> km × Rp <span x-text="pengiriman.harga_per_km.toLocaleString('id-ID')"></span>/km
                </p>
              </div>
              
              <!-- Koordinat Display -->
              <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                  <label class="block text-sm font-fredoka font-semibold mb-1 text-gray-700">
                    <i class="fas fa-map-pin text-red-500 mr-1"></i> Latitude Anda
                  </label>
                  <input 
                    type="text" 
                    x-model="location.latitude" 
                    readonly 
                    class="w-full px-4 py-2 bg-gray-100 border-2 border-gray-300 rounded-lg font-fredoka text-sm"
                    placeholder="Belum dipilih">
                </div>
                <div>
                  <label class="block text-sm font-fredoka font-semibold mb-1 text-gray-700">
                    <i class="fas fa-map-pin text-red-500 mr-1"></i> Longitude Anda
                  </label>
                  <input 
                    type="text" 
                    x-model="location.longitude" 
                    readonly 
                    class="w-full px-4 py-2 bg-gray-100 border-2 border-gray-300 rounded-lg font-fredoka text-sm"
                    placeholder="Belum dipilih">
                </div>
              </div>
              
              <!-- Alamat Otomatis (dari reverse geocoding) -->
              <div x-show="customer.address" class="mb-4 bg-green-50 border-2 border-green-300 rounded-xl p-4">
                <label class="block text-sm font-fredoka font-semibold mb-2 text-green-700">
                  <i class="fas fa-check-circle mr-1"></i> Alamat Terdeteksi:
                </label>
                <p class="font-fredoka text-base text-gray-800" x-text="customer.address"></p>
              </div>
              
              <!-- Catatan Tambahan Alamat -->
              <div class="mb-4">
                <label class="block text-lg font-fredoka mb-2">
                  <i class="fas fa-sticky-note mr-2"></i>
                  Catatan Tambahan Alamat (Opsional)
                </label>
                <textarea 
                  x-model="customer.catatan_alamat" 
                  rows="3" 
                  class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#6B8E23] font-fredoka text-lg" 
                  placeholder="Contoh: Rumah pagar hitam, dekat masjid Al-Ikhlas, RT 03 RW 05, sebelah warung Pak Budi"></textarea>
                <p class="text-sm font-fredoka text-gray-500 mt-1">
                  <i class="fas fa-info-circle mr-1"></i>
                  Tambahkan patokan, warna rumah, RT/RW, atau detail yang memudahkan driver menemukan lokasi Anda
                </p>
              </div>
              
              <!-- Status Validasi -->
              <div x-show="!location.latitude || !location.longitude" class="bg-yellow-50 border-2 border-yellow-400 rounded-xl p-3">
                <p class="text-sm font-fredoka text-yellow-700">
                  <i class="fas fa-exclamation-triangle mr-1"></i>
                  <strong>Perhatian:</strong> Anda belum memilih lokasi di peta. Geser pin merah atau klik pada peta untuk menentukan lokasi pengiriman.
                </p>
              </div>
              
              <div x-show="location.latitude && location.longitude && pengiriman.jarak_km > 0" class="bg-green-50 border-2 border-green-300 rounded-xl p-3">
                <p class="text-sm font-fredoka text-green-700">
                  <i class="fas fa-check-circle mr-1"></i>
                  <strong>Lokasi sudah dipilih!</strong> Jarak: <span x-text="pengiriman.jarak_km.toFixed(2)"></span> km | Ongkir: Rp <span x-text="pengiriman.ongkir.toLocaleString('id-ID')"></span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-3xl shadow-lg p-6 border-2 border-[#BC5A45] sticky top-32">
            <h2 class="text-3xl font-bubble text-[#BC5A45] mb-4">Ringkasan Pesanan</h2>
            
            <!-- Cart Items -->
            <div class="max-h-60 overflow-y-auto mb-4">
              <template x-for="item in cart" :key="item.id">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                  <div>
                    <p class="font-fredoka font-semibold" x-text="item.name"></p>
                    <p class="text-sm text-gray-600" x-text="item.quantity + ' x Rp ' + item.price.toLocaleString('id-ID')"></p>
                  </div>
                  <p class="font-fredoka font-bold text-[#BC5A45]" x-text="'Rp ' + (item.price * item.quantity).toLocaleString('id-ID')"></p>
                </div>
              </template>
            </div>
            
            <!-- Subtotal -->
            <div class="flex justify-between py-2">
              <span class="font-fredoka">Subtotal</span>
              <span class="font-fredoka font-bold" x-text="'Rp ' + subtotal.toLocaleString('id-ID')"></span>
            </div>
            
            <!-- Ongkir -->
            <div class="flex justify-between py-2">
              <span class="font-fredoka">Ongkos Kirim</span>
              <span class="font-fredoka font-bold" x-text="delivery.method === 'delivery' ? 'Rp ' + pengiriman.ongkir.toLocaleString('id-ID') : 'Rp 0'"></span>
            </div>
            
            <!-- Total -->
            <div class="flex justify-between py-2 text-xl font-bold border-t border-gray-200 mt-2 pt-2">
              <span class="font-bubble">Total</span>
              <span class="font-bubble text-[#BC5A45]" x-text="'Rp ' + total.toLocaleString('id-ID')"></span>
            </div>
            
            <!-- Next Button -->
            <button @click="goToStep2()" :disabled="!canProceedToStep2" class="w-full bg-[#6B8E23] text-white py-3 rounded-full font-bubble text-xl mt-4 hover:bg-[#5a7520] transition disabled:opacity-50 disabled:cursor-not-allowed">
              Lanjut ke Pembayaran →
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- STEP 2: PEMBAYARAN -->
    <div x-show="step === 2" x-cloak>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Payment Methods -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-3xl shadow-lg p-6 mb-6 border-2 border-[#6B8E23]">
            <h2 class="text-3xl font-bubble text-[#6B8E23] mb-4">Metode Pembayaran</h2>
            
            <!-- QRIS -->
            <div class="payment-method" :class="{ 'selected': payment.method === 'qris' }" @click="payment.method = 'qris'">
              <div class="flex items-center gap-4">
                <input type="radio" name="payment" value="qris" x-model="payment.method" class="w-5 h-5">
                <div class="flex-1">
                  <div class="flex items-center gap-2">
                    <h3 class="text-xl font-bubble text-[#6B8E23]">QRIS</h3>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/QRIS_logo.svg/1200px-QRIS_logo.svg.png" alt="QRIS" class="h-8">
                  </div>
                  <p class="text-sm font-fredoka">Bayar pakai OVO, GoPay, Dana, ShopeePay, LinkAja, dll</p>
                </div>
              </div>
            </div>

            <!-- Transfer Bank -->
            <div class="payment-method" :class="{ 'selected': payment.method === 'transfer' }" @click="payment.method = 'transfer'">
              <div class="flex items-center gap-4">
                <input type="radio" name="payment" value="transfer" x-model="payment.method" class="w-5 h-5">
                <div>
                  <h3 class="text-xl font-bubble text-[#6B8E23]">Transfer Bank</h3>
                  <p class="text-sm font-fredoka">BCA • Mandiri • BRI • BNI</p>
                </div>
              </div>
            </div>

            <!-- Cash on Delivery -->
            <div class="payment-method" :class="{ 'selected': payment.method === 'cod' }" @click="payment.method = 'cod'">
              <div class="flex items-center gap-4">
                <input type="radio" name="payment" value="cod" x-model="payment.method" class="w-5 h-5">
                <div>
                  <h3 class="text-xl font-bubble text-[#6B8E23]">Bayar di Tempat (COD)</h3>
                  <p class="text-sm font-fredoka">Hanya untuk pengiriman GoSend</p>
                </div>
              </div>
            </div>
          </div>

          <!-- QRIS Details (muncul jika pilih QRIS) -->
          <div x-show="payment.method === 'qris'" x-cloak class="bg-white rounded-3xl shadow-lg p-6 mb-6 border-2 border-[#BC5A45]">
            <h3 class="text-2xl font-bubble text-[#BC5A45] mb-4">Scan QRIS untuk Membayar</h3>
            
            <div class="flex flex-col md:flex-row items-center gap-8">
              <!-- QR Code -->
              <div class="bg-white p-4 rounded-2xl shadow-lg">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=INVOICE-{{ uniqid() }}" alt="QRIS" class="w-48 h-48">
                <p class="text-center text-sm font-fredoka mt-2">Total: <span class="font-bold" x-text="'Rp ' + total.toLocaleString('id-ID')"></span></p>
              </div>
              
              <!-- Instructions -->
              <div class="flex-1">
                <h4 class="font-bubble text-xl mb-3">Cara Pembayaran QRIS:</h4>
                <ul class="list-disc pl-5 font-fredoka space-y-2">
                  <li>Buka aplikasi OVO/GoPay/Dana/ShopeePay</li>
                  <li>Pilih menu "Scan QR" atau "Bayar QRIS"</li>
                  <li>Scan QR code di samping</li>
                  <li>Periksa nominal pembayaran (harus sesuai)</li>
                  <li>Konfirmasi pembayaran</li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Transfer Bank Details -->
          <div x-show="payment.method === 'transfer'" x-cloak class="bg-white rounded-3xl shadow-lg p-6 mb-6 border-2 border-[#BC5A45]">
            <h3 class="text-2xl font-bubble text-[#BC5A45] mb-4">Transfer ke Rekening Berikut</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="bg-gray-50 p-4 rounded-xl">
                <p class="font-bubble text-[#6B8E23] text-xl">BCA</p>
                <p class="font-fredoka text-2xl font-bold mt-2">123 456 7890</p>
                <p class="font-fredoka">a.n. PempekBunda 75</p>
              </div>
              <div class="bg-gray-50 p-4 rounded-xl">
                <p class="font-bubble text-[#6B8E23] text-xl">Mandiri</p>
                <p class="font-fredoka text-2xl font-bold mt-2">1230 1234 5678</p>
                <p class="font-fredoka">a.n. PempekBunda 75</p>
              </div>
              <div class="bg-gray-50 p-4 rounded-xl">
                <p class="font-bubble text-[#6B8E23] text-xl">BRI</p>
                <p class="font-fredoka text-2xl font-bold mt-2">1234 01 123456 7</p>
                <p class="font-fredoka">a.n. PempekBunda 75</p>
              </div>
              <div class="bg-gray-50 p-4 rounded-xl">
                <p class="font-bubble text-[#6B8E23] text-xl">BNI</p>
                <p class="font-fredoka text-2xl font-bold mt-2">1234567890</p>
                <p class="font-fredoka">a.n. PempekBunda 75</p>
              </div>
            </div>
            
            <p class="text-sm font-fredoka text-gray-500 mt-4">*Konfirmasi pembayaran dengan mengirim bukti transfer ke WhatsApp kami</p>
          </div>

          <!-- Verification Checkbox -->
          <div x-show="payment.method !== ''" x-cloak class="bg-white rounded-3xl shadow-lg p-6 border-2 border-[#6B8E23]">
            <h3 class="text-2xl font-bubble text-[#6B8E23] mb-4">Verifikasi Pembayaran</h3>
            
            <div class="space-y-4">
              <div class="flex items-center gap-3">
                <input type="checkbox" x-model="payment.verified.ovo" class="w-5 h-5 accent-[#6B8E23]">
                <span class="font-fredoka">Saya bayar dari OVO atas nama <input type="text" x-model="payment.ovoName" placeholder="Nama di OVO" class="border-b border-gray-300 px-2 py-1 focus:border-[#6B8E23] outline-none"></span>
              </div>
              
              <div class="flex items-center gap-3">
                <input type="checkbox" x-model="payment.verified.gopay" class="w-5 h-5 accent-[#6B8E23]">
                <span class="font-fredoka">Saya bayar dari GoPay atas nama <input type="text" x-model="payment.gopayName" placeholder="Nama di GoPay" class="border-b border-gray-300 px-2 py-1 focus:border-[#6B8E23] outline-none"></span>
              </div>
              
              <div class="flex items-center gap-3">
                <input type="checkbox" x-model="payment.verified.dana" class="w-5 h-5 accent-[#6B8E23]">
                <span class="font-fredoka">Saya bayar dari Dana atas nama <input type="text" x-model="payment.danaName" placeholder="Nama di Dana" class="border-b border-gray-300 px-2 py-1 focus:border-[#6B8E23] outline-none"></span>
              </div>
              
              <div class="flex items-center gap-3">
                <input type="checkbox" x-model="payment.verified.shopee" class="w-5 h-5 accent-[#6B8E23]">
                <span class="font-fredoka">Saya bayar dari ShopeePay atas nama <input type="text" x-model="payment.shopeeName" placeholder="Nama di ShopeePay" class="border-b border-gray-300 px-2 py-1 focus:border-[#6B8E23] outline-none"></span>
              </div>
              
              <div class="flex items-center gap-3">
                <input type="checkbox" x-model="payment.verified.bank" class="w-5 h-5 accent-[#6B8E23]">
                <span class="font-fredoka">Saya transfer dari bank atas nama <input type="text" x-model="payment.bankName" placeholder="Nama pengirim" class="border-b border-gray-300 px-2 py-1 focus:border-[#6B8E23] outline-none"></span>
              </div>
            </div>
            
            <p class="text-sm font-fredoka text-gray-500 mt-4">*Centang sesuai metode yang kamu gunakan dan isi nama akun untuk verifikasi</p>
          </div>
        </div>

        <!-- Right Column: Summary -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-3xl shadow-lg p-6 border-2 border-[#BC5A45] sticky top-32">
            <h2 class="text-3xl font-bubble text-[#BC5A45] mb-4">Ringkasan</h2>
            
            <div class="mb-4">
              <p class="font-fredoka font-semibold">Metode Pengiriman:</p>
              <p x-text="delivery.method === 'pickup' ? 'Ambil Sendiri' : 'GoSend'" class="text-[#6B8E23]"></p>
            </div>
            
            <div class="mb-4">
              <p class="font-fredoka font-semibold">Metode Pembayaran:</p>
              <p x-text="payment.method === 'qris' ? 'QRIS' : (payment.method === 'transfer' ? 'Transfer Bank' : 'COD')" class="text-[#6B8E23] uppercase"></p>
            </div>
            
            <div class="flex justify-between py-2">
              <span class="font-fredoka">Subtotal</span>
              <span class="font-fredoka font-bold" x-text="'Rp ' + subtotal.toLocaleString('id-ID')"></span>
            </div>
            
            <div class="flex justify-between py-2">
              <span class="font-fredoka">Ongkir</span>
              <span class="font-fredoka font-bold" x-text="delivery.method === 'delivery' ? 'Rp 15.000' : 'Rp 0'"></span>
            </div>
            
            <div class="flex justify-between py-2 text-xl font-bold border-t border-gray-200 mt-2 pt-2">
              <span class="font-bubble">Total</span>
              <span class="font-bubble text-[#BC5A45]" x-text="'Rp ' + total.toLocaleString('id-ID')"></span>
            </div>
            
            <!-- Previous & Next Buttons -->
            <div class="flex gap-3 mt-6">
              <button @click="step = 1" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-full font-bubble text-lg hover:bg-gray-300 transition">
                ← Kembali
              </button>
              <button @click="processOrder()" :disabled="!canProceedToStep3" class="flex-1 bg-[#6B8E23] text-white py-3 rounded-full font-bubble text-lg hover:bg-[#5a7520] transition disabled:opacity-50 disabled:cursor-not-allowed">
                Buat Pesanan
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- STEP 3: KONFIRMASI & INVOICE -->
    <div x-show="step === 3" x-cloak>
      <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-3xl shadow-2xl p-8 border-4 border-[#6B8E23] text-center">
          <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-check text-white text-5xl"></i>
          </div>
          
          <h2 class="text-4xl font-bubble text-[#6B8E23] mb-2">Pesanan Berhasil Dibuat!</h2>
          <p class="text-xl font-fredoka text-gray-600 mb-6" x-text="'No. Invoice: ' + order.invoice"></p>
          
          <div class="bg-yellow-50 border-2 border-yellow-400 rounded-xl p-4 mb-6">
            <p class="font-fredoka text-lg">
              <i class="fas fa-clock text-yellow-500 mr-2"></i>
              Batas konfirmasi pembayaran: <span class="font-bold" x-text="order.paymentDeadline"></span>
            </p>
            <p class="text-sm font-fredoka text-gray-600 mt-1">(Waktu tersisa 12 jam dari sekarang)</p>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-50 rounded-xl p-4 text-left">
              <h3 class="font-bubble text-[#BC5A45] text-xl mb-2">Detail Pemesan</h3>
              <p class="font-fredoka"><span class="font-semibold">Nama:</span> <span x-text="customer.name"></span></p>
              <p class="font-fredoka"><span class="font-semibold">Email:</span> <span x-text="customer.email"></span></p>
              <p class="font-fredoka"><span class="font-semibold">WA:</span> <span x-text="customer.phone"></span></p>
              <p class="font-fredoka" x-show="delivery.method === 'delivery'"><span class="font-semibold">Alamat:</span> <span x-text="customer.address"></span></p>
            </div>
            
            <div class="bg-gray-50 rounded-xl p-4 text-left">
              <h3 class="font-bubble text-[#BC5A45] text-xl mb-2">Detail Pesanan</h3>
              <p class="font-fredoka"><span class="font-semibold">Total Bayar:</span> <span class="text-[#BC5A45] font-bold" x-text="'Rp ' + total.toLocaleString('id-ID')"></span></p>
              <p class="font-fredoka"><span class="font-semibold">Metode Bayar:</span> <span x-text="payment.method === 'qris' ? 'QRIS' : (payment.method === 'transfer' ? 'Transfer Bank' : 'COD')"></span></p>
              <p class="font-fredoka"><span class="font-semibold">Pengiriman:</span> <span x-text="delivery.method === 'pickup' ? 'Ambil Sendiri' : 'GoSend'"></span></p>
            </div>
          </div>
          
          <!-- Timeline Status -->
          <div class="border-t-2 border-gray-200 pt-6 mb-6">
            <h3 class="text-2xl font-bubble text-[#6B8E23] mb-4">Status Pesanan</h3>
            
            <div class="space-y-4 text-left">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-bold">✓</div>
                <div>
                  <p class="font-fredoka font-semibold">Pesanan Dibuat</p>
                  <p class="text-sm text-gray-500" x-text="order.createdAt"></p>
                </div>
              </div>
              
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white text-sm font-bold">1</div>
                <div>
                  <p class="font-fredoka font-semibold">Menunggu Pembayaran</p>
                  <p class="text-sm text-gray-500">Silakan lakukan pembayaran sebelum batas waktu</p>
                </div>
              </div>
              
              <div class="flex items-center gap-3 opacity-50">
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white text-sm font-bold">2</div>
                <div>
                  <p class="font-fredoka font-semibold">Menunggu Konfirmasi Admin</p>
                  <p class="text-sm text-gray-500">Akan diproses setelah pembayaran dikonfirmasi</p>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-4">
            <a href="https://wa.me/6281234567890?text=Halo%20Bunda%2C%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20invoice%20" + order.invoice class="flex-1 bg-green-500 text-white py-3 rounded-full font-bubble text-xl hover:bg-green-600 transition flex items-center justify-center gap-2">
              <i class="fab fa-whatsapp"></i> Konfirmasi via WhatsApp
            </a>
            <a href="{{ route('order.my-orders') }}" class="flex-1 bg-[#6B8E23] text-white py-3 rounded-full font-bubble text-xl hover:bg-[#5a7520] transition">
              Lihat Pesanan Saya
            </a>
          </div>
          
          <p class="text-sm font-fredoka text-gray-500 mt-4">
            <i class="fas fa-info-circle mr-1"></i>
            Simpan nomor invoice untuk lacak pesanan
          </p>
        </div>
      </div>
    </div>

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
        <img src="{{ asset('assets/images/logobrand.png') }}" alt="PempekBunda 75 Logo" class="footer-logo">
      </a>
    </div>
  </footer>

  <!-- CHECKOUT SYSTEM SCRIPT -->
  <script>
    function checkoutSystem() {
      return {
        step: 1,
        cart: [],
        subtotal: 0,
        total: 0,
        
        customer: {
          name: '{{ auth()->user()->name ?? "Guest User" }}',
          email: '{{ auth()->user()->email ?? "guest@example.com" }}',
          phone: '',
          address: '',
          catatan_alamat: ''
        },
        
        // Koordinat Toko (Fixed) - Purbalingga
        toko: {
          latitude: -7.372085,
          longitude: 109.241568,
          nama: 'PempekBunda 75'
        },
        
        // Koordinat User (Draggable)
        location: {
          latitude: null,
          longitude: null
        },
        
        // Jarak & Ongkir
        pengiriman: {
          jarak_km: 0,
          ongkir: 0,
          harga_per_km: 2500  // Rp 2.500 per km
        },
        
        mapLoading: true,
        embeddedMap: null,
        tokoMarker: null,    // Marker toko (fixed)
        userMarker: null,    // Marker user (draggable)
        geocoder: null,
        
        delivery: {
          method: 'pickup' // pickup or delivery
        },
        
        payment: {
          method: '',
          verified: {
            ovo: false,
            gopay: false,
            dana: false,
            shopee: false,
            bank: false
          },
          ovoName: '',
          gopayName: '',
          danaName: '',
          shopeeName: '',
          bankName: ''
        },
        
        order: {
          invoice: '',
          createdAt: '',
          paymentDeadline: ''
        },
        
        initCheckout() {
          // Load cart from localStorage
          const savedCart = localStorage.getItem('cart');
          if (savedCart) {
            this.cart = JSON.parse(savedCart);
            this.calculateTotals();
          } else {
            // If cart empty, redirect back to order page
            window.location.href = '{{ route('order.index') }}';
          }
          
          // Initialize embedded map after a short delay
          setTimeout(() => {
            this.initializeEmbeddedMap();
          }, 500);
        },
        
        calculateTotals() {
          this.subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
          // Total = subtotal + ongkir (jika delivery)
          const ongkir = this.delivery.method === 'delivery' ? this.pengiriman.ongkir : 0;
          this.total = this.subtotal + ongkir;
        },
        
        get canProceedToStep2() {
          // Jika delivery, WAJIB ada koordinat lokasi DAN jarak sudah dihitung
          if (this.delivery.method === 'delivery') {
            return this.customer.phone !== '' && 
                   this.customer.address !== '' &&
                   this.location.latitude !== null && 
                   this.location.longitude !== null &&
                   this.pengiriman.jarak_km > 0;
          }
          
          // Jika pickup, cukup phone saja
          return this.customer.phone !== '';
        },
        
        get canProceedToStep3() {
          if (!this.payment.method) return false;
          
          if (this.payment.method === 'qris') {
            return this.payment.verified.ovo || this.payment.verified.gopay || 
                   this.payment.verified.dana || this.payment.verified.shopee;
          }
          
          if (this.payment.method === 'transfer') {
            return this.payment.verified.bank && this.payment.bankName !== '';
          }
          
          return this.payment.method === 'cod' && this.delivery.method === 'delivery';
        },
        
        goToStep2() {
          this.calculateTotals();
          this.step = 2;
        },
        
        processOrder() {
          // Generate invoice number
          const date = new Date();
          const invoice = 'INV/PB/' + date.getFullYear() + 
                         ('0' + (date.getMonth() + 1)).slice(-2) + 
                         ('0' + date.getDate()).slice(-2) + '/' +
                         Math.floor(Math.random() * 10000).toString().padStart(4, '0');
          
          // Set deadline (12 hours from now)
          const deadline = new Date(date.getTime() + 12 * 60 * 60 * 1000);
          const deadlineStr = deadline.toLocaleDateString('id-ID', { 
            day: '2-digit', 
            month: 'long', 
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
          });
          
          this.order = {
            invoice: invoice,
            createdAt: date.toLocaleDateString('id-ID', { 
              day: '2-digit', 
              month: 'long', 
              year: 'numeric',
              hour: '2-digit',
              minute: '2-digit'
            }),
            paymentDeadline: deadlineStr
          };
          
          // Clear cart
          localStorage.removeItem('cart');
          
          // Go to step 3
          this.step = 3;
          
          // Here you would typically send data to server via AJAX
          console.log('Order placed:', {
            customer: {
              ...this.customer,
              catatan_alamat: this.customer.catatan_alamat
            },
            delivery: this.delivery,
            payment: this.payment,
            cart: this.cart,
            total: this.total,
            invoice: this.order.invoice,
            location: {
              latitude_user: parseFloat(this.location.latitude),
              longitude_user: parseFloat(this.location.longitude),
              latitude_toko: this.toko.latitude,
              longitude_toko: this.toko.longitude,
              jarak_km: this.pengiriman.jarak_km,
              ongkir: this.pengiriman.ongkir,
              catatan_alamat: this.customer.catatan_alamat
            }
          });
        },
        
        // 🗺️ LEAFLET MAP FUNCTIONS (100% GRATIS - TIDAK PERLU API KEY!)
        initializeEmbeddedMap() {
          console.log('🗺️ Initializing embedded map...');
          
          // Cek apakah Leaflet sudah loaded
          if (typeof L === 'undefined') {
            console.error('❌ Leaflet belum loaded! Coba lagi...');
            setTimeout(() => this.initializeEmbeddedMap(), 500);
            return;
          }
          
          console.log('✅ Leaflet loaded!');
          
          // Koordinat Toko (Fixed)
          const tokoLat = this.toko.latitude;
          const tokoLng = this.toko.longitude;
          
          console.log('📍 Koordinat Toko:', tokoLat, tokoLng);
          
          // Default lokasi user: dekat toko (offset sedikit)
          const defaultUserLat = tokoLat + 0.01;  // ~1km ke utara
          const defaultUserLng = tokoLng + 0.01;  // ~1km ke timur
          
          try {
            // Initialize Leaflet map
            console.log('🗺️ Creating map...');
            this.embeddedMap = L.map('embedded-map').setView([tokoLat, tokoLng], 14);
            
            // Add OpenStreetMap tiles (GRATIS!)
            console.log('🗺️ Adding tiles...');
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '© OpenStreetMap contributors',
              maxZoom: 19
            }).addTo(this.embeddedMap);
            
            // === MARKER 1: TOKO (FIXED - BIRU) ===
            console.log('📍 Adding toko marker...');
            const tokoIcon = L.divIcon({
              html: '<div style="background-color: #3B82F6; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; display: flex; align-items: center; justify-content: center; font-size: 16px; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">🏪</div>',
              className: 'custom-marker',
              iconSize: [30, 30],
              iconAnchor: [15, 15]
            });
            
            this.tokoMarker = L.marker([tokoLat, tokoLng], {
              icon: tokoIcon,
              draggable: false  // TIDAK BISA DIGESER
            }).addTo(this.embeddedMap);
            
            this.tokoMarker.bindPopup(`
              <div style="padding: 5px; font-family: Arial;">
                <h3 style="margin: 0 0 5px 0; color: #3B82F6; font-size: 14px;">🏪 ${this.toko.nama}</h3>
                <p style="margin: 0; font-size: 11px; color: #666;">Lokasi Toko (Fixed)</p>
                <p style="margin: 5px 0 0 0; font-size: 10px; color: #999;">
                  ${tokoLat.toFixed(6)}, ${tokoLng.toFixed(6)}
                </p>
              </div>
            `);
            
            // === MARKER 2: USER (DRAGGABLE - MERAH) ===
            console.log('📍 Adding user marker...');
            const userIcon = L.divIcon({
              html: '<div style="background-color: #EF4444; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; display: flex; align-items: center; justify-content: center; font-size: 16px; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">📍</div>',
              className: 'custom-marker',
              iconSize: [30, 30],
              iconAnchor: [15, 15]
            });
            
            this.userMarker = L.marker([defaultUserLat, defaultUserLng], {
              icon: userIcon,
              draggable: true  // BISA DIGESER
            }).addTo(this.embeddedMap);
            
            this.userMarker.bindPopup('Geser pin ini ke lokasi Anda atau klik peta');
            
            // Set initial user location
            this.updateLocation(defaultUserLat, defaultUserLng);
            
            // Listen to user marker drag end
            this.userMarker.on('dragend', () => {
              const position = this.userMarker.getLatLng();
              this.updateLocation(position.lat, position.lng);
            });
            
            // Listen to map click (pindahkan user marker)
            this.embeddedMap.on('click', (event) => {
              const lat = event.latlng.lat;
              const lng = event.latlng.lng;
              
              // Move user marker to clicked position
              this.userMarker.setLatLng([lat, lng]);
              
              // Update location
              this.updateLocation(lat, lng);
            });
            
            console.log('✅ Map initialized successfully!');
            this.mapLoading = false;
            
          } catch (error) {
            console.error('❌ Error initializing map:', error);
            this.mapLoading = false;
            alert('Gagal memuat peta. Silakan refresh halaman.');
          }
        },
        
        updateLocation(lat, lng) {
          // Update user coordinates
          this.location.latitude = lat.toFixed(7);
          this.location.longitude = lng.toFixed(7);
          
          // Calculate distance & ongkir
          this.calculateDistance();
          
          // Reverse geocode to get address (menggunakan Nominatim - GRATIS!)
          this.reverseGeocode(lat, lng);
          
          // Recalculate totals (karena ongkir berubah)
          this.calculateTotals();
        },
        
        calculateDistance() {
          // Haversine formula untuk menghitung jarak antara 2 koordinat
          const R = 6371; // Radius bumi dalam km
          
          const lat1 = this.toko.latitude * Math.PI / 180;
          const lat2 = parseFloat(this.location.latitude) * Math.PI / 180;
          const deltaLat = (parseFloat(this.location.latitude) - this.toko.latitude) * Math.PI / 180;
          const deltaLng = (parseFloat(this.location.longitude) - this.toko.longitude) * Math.PI / 180;
          
          const a = Math.sin(deltaLat / 2) * Math.sin(deltaLat / 2) +
                    Math.cos(lat1) * Math.cos(lat2) *
                    Math.sin(deltaLng / 2) * Math.sin(deltaLng / 2);
          
          const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
          
          const jarak = R * c; // Jarak dalam km
          
          // Update jarak
          this.pengiriman.jarak_km = jarak;
          
          // Hitung ongkir (jarak × harga per km)
          this.pengiriman.ongkir = Math.round(jarak * this.pengiriman.harga_per_km);
        },
        
        reverseGeocode(lat, lng) {
          // Menggunakan Nominatim (OpenStreetMap) - 100% GRATIS!
          fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
            .then(response => response.json())
            .then(data => {
              if (data && data.display_name) {
                this.customer.address = data.display_name;
              } else {
                this.customer.address = `Koordinat: ${lat}, ${lng}`;
              }
            })
            .catch(error => {
              console.error('Reverse geocoding error:', error);
              this.customer.address = `Koordinat: ${lat}, ${lng}`;
            });
        }
      }
    }
  </script>

  <style>
    [x-cloak] { display: none !important; }
    
    .header .logo-container .logo-link .brand-logo {
      width: 150px;
    }
    
    .nav-link {
      text-decoration: none;
      color: #000;
      font-size: clamp(20px, 2.5vw, 32px);
      position: relative;
      padding: 5px 0;
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
    
    .nav-link:hover::after {
      width: 100%;
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
    }
    
    .btn-header:hover {
      background: #b55242;
      transform: translateY(-2px);
    }
    
    .footer-link {
      color: #fff;
      text-decoration: none;
      font-size: clamp(20px, 2.2vw, 32px);
      transition: color 0.3s ease;
    }
    
    .footer-link:hover {
      color: #ffd9cc;
    }
    
    .footer-logo {
      width: 150px;
    }
  </style>

</body>
</html>
