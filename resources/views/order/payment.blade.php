<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran - Pempek Bunda 75</title>
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- CSP untuk mengizinkan eval() yang digunakan Alpine.js -->
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval' 'unsafe-inline' https://cdn.jsdelivr.net https://cdn.tailwindcss.com https://cdnjs.cloudflare.com https://fonts.googleapis.com https://fonts.gstatic.com;">

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
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Coming+Soon&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Alpine.js untuk payment - Gunakan versi spesifik -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>
  
  <style>
    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      min-height: 100vh;
    }
    
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: #FFF8EE;
      color: #5C3D2E;
      overflow-x: hidden;
      overflow-y: auto;
    }
    
    .font-handwritten {
      font-family: 'Coming Soon', cursive;
    }
    
    .font-reenie {
      font-family: 'Reenie Beanie', cursive;
    }
    
    .animate-fade-in {
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .animate-bounce {
      animation: bounce 1s infinite;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }

    [x-cloak] { display: none !important; }

    /* Container utama untuk konten */
    .main-wrapper {
      width: 100%;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding: 20px;
    }

    .center-container {
      width: 100%;
      max-width: 1400px;
      margin: 0 auto;
    }

    /* Container produk yang dibeli */
    .product-summary-container {
      background-color: white;
      border-radius: 1rem;
      border: 1px solid #E8DCC4;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .product-summary-title {
      font-size: 1.25rem;
      font-weight: bold;
      color: #C6584F;
      border-bottom: 1px solid #E8DCC4;
      padding-bottom: 0.5rem;
      margin-bottom: 1rem;
    }

    .product-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem 0;
      border-bottom: 1px dashed #E8DCC4;
    }

    .product-item:last-child {
      border-bottom: none;
    }

    .product-item-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .product-item-image {
      width: 60px;
      height: 60px;
      border-radius: 0.5rem;
      object-fit: cover;
      background-color: #f3f4f6;
    }

    .product-item-details h4 {
      font-weight: 600;
      color: #5C3D2E;
    }

    .product-item-details p {
      font-size: 0.875rem;
      color: #6B7280;
    }

    .product-item-price {
      font-weight: bold;
      color: #C6584F;
    }

    .back-to-cart {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: #C6584F;
      font-family: 'Reenie Beanie', cursive;
      font-size: 2rem;
      text-decoration: none;
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
    }

    .back-to-cart:hover {
      color: #b04d45;
      transform: translateX(-5px);
    }

    /* Title dengan ukuran yang pas */
    .page-title {
      color: #7c2d12;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
      margin-bottom: 1.5rem;
      line-height: 1.2;
      word-break: break-word;
      font-size: 3.5rem;
    }

    @media (max-width: 768px) {
      .page-title {
        font-size: 2.5rem;
      }
    }

    @media (min-width: 1400px) {
      .page-title {
        font-size: 5rem;
      }
    }

    /* Style untuk input error */
    .input-error {
      border-color: #C6584F !important;
      background-color: #FEF2F2 !important;
    }

    .error-message {
      color: #C6584F;
      font-size: 0.75rem;
      margin-top: 0.25rem;
    }

    /* Form spacing */
    .form-section {
      margin-bottom: 2rem;
    }

    /* Info lokasi kantor */
    .office-location-info {
      background-color: #E8DCC4;
      border-radius: 0.5rem;
      padding: 0.75rem;
      margin-bottom: 1rem;
      font-size: 0.875rem;
      color: #5C3D2E;
    }

    /* Debug info (hapus nanti) */
    .debug-info {
      font-size: 10px;
      color: #999;
      margin-top: 5px;
    }
  </style>
</head>
<body>

  <div class="main-wrapper">
    <div class="center-container">
      <main class="animate-fade-in">

        <!-- Back to Cart Link - FONT REENIE -->
        <a href="{{ route('order.index') }}" class="back-to-cart">
          <i class="fas fa-arrow-left"></i> Kembali ke Keranjang
        </a>

        <!-- TITLE MENGGUNAKAN FONT RASCAL -->
        <h2 class="font-rascal page-title">Data Pesanan</h2>

        <!-- LOADING STATE -->
        <div x-data="paymentPage()" x-init="init()">
          <div x-show="loading" class="text-center py-20">
            <i class="fas fa-spinner fa-spin text-4xl text-[#758E27]"></i>
            <p class="mt-4">Memuat data...</p>
          </div>

          <!-- FORM UTAMA -->
          <div x-show="!loading">
            
            <!-- PRODUCT SUMMARY - DAFTAR PRODUK YANG DIBELI (READ ONLY) -->
            <div class="product-summary-container" x-show="cart.length > 0">
              <h3 class="product-summary-title">
                <i class="fas fa-shopping-bag mr-2"></i>
                Produk yang Anda Beli
              </h3>
              
              <div class="space-y-2">
                <template x-for="(item, index) in cart" :key="item.id">
                  <div class="product-item">
                    <div class="product-item-info">
                      <img x-bind:src="item.image" x-bind:alt="item.name" class="product-item-image">
                      <div class="product-item-details">
                        <h4 x-text="item.name"></h4>
                        <p><span x-text="item.quantity"></span> x Rp <span x-text="item.price.toLocaleString('id-ID')"></span></p>
                      </div>
                    </div>
                    <div class="product-item-price">
                      Rp <span x-text="(item.price * item.quantity).toLocaleString('id-ID')"></span>
                    </div>
                  </div>
                </template>
                
                <!-- Total Belanja -->
                <div class="flex justify-between items-center pt-3 mt-2 border-t-2 border-[#E8DCC4] font-bold">
                  <span>Total Belanja:</span>
                  <span class="text-[#C6584F] text-xl" x-text="'Rp ' + subtotal.toLocaleString('id-ID')"></span>
                </div>
              </div>
            </div>

            <form @submit.prevent="submitForm" class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <div class="space-y-6">
                <!-- Data Pemesan -->
                <section class="bg-white p-6 rounded-2xl border border-[#E8DCC4] shadow-sm space-y-4">
                  <h3 class="text-lg font-bold text-[#C6584F] border-b pb-2">Data Pemesan</h3>
                  <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                    <input 
                      type="text" 
                      x-model="formData.name"
                      value="{{ auth()->user()->name ?? 'Customer Bunda' }}"
                      readonly
                      class="w-full bg-[#FFF8EE] border border-[#E8DCC4] rounded-lg p-2 text-[#5C3D2E] focus:outline-none"
                    >
                  </div>
                  <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Email (Otomatis)</label>
                    <input 
                      type="email" 
                      x-model="formData.email"
                      value="{{ auth()->user()->email ?? 'customer@gmail.com' }}"
                      readonly
                      class="w-full bg-[#FFF8EE] border border-[#E8DCC4] rounded-lg p-2 text-[#5C3D2E] focus:outline-none"
                    >
                  </div>
                  <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">WhatsApp <span class="text-red-500">*</span></label>
                    <input 
                      type="tel" 
                      required
                      x-model="formData.whatsapp"
                      @input="validateWhatsApp"
                      :class="{ 'input-error': whatsappError }"
                      placeholder="081234567890 (hanya angka)"
                      class="w-full border border-[#E8DCC4] rounded-lg p-2 text-[#5C3D2E] focus:ring-1 focus:ring-[#C6584F] outline-none"
                    >
                    <div x-show="whatsappError" class="error-message" x-text="whatsappError"></div>
                    <p class="text-[10px] text-gray-400 mt-1">Contoh: 081234567890 (tanpa spasi atau tanda baca)</p>
                  </div>
                </section>

                <!-- Alamat Spesifik -->
                <section class="bg-white p-6 rounded-2xl border border-[#E8DCC4] shadow-sm space-y-4">
                  <div class="flex justify-between items-center border-b pb-2">
                    <h3 class="text-lg font-bold text-[#C6584F]">Alamat Spesifik</h3>
                    <button 
                      type="button"
                      @click="getCurrentLocation"
                      class="text-xs bg-[#758E27] text-white px-3 py-1 rounded-full flex items-center gap-1 hover:opacity-80 transition"
                    >
                      <i class="fas fa-map-marker-alt"></i> Ambil Lokasi
                    </button>
                  </div>
                  
                  <!-- Info Lokasi Kantor -->
                  <div class="office-location-info">
                    <i class="fas fa-store mr-1"></i>
                    <span class="font-bold">Lokasi Toko:</span> -7.372085, 109.241568
                  </div>
                  
                  <textarea 
                    required
                    rows="4"
                    x-model="formData.address"
                    placeholder="Contoh: Jl. Mawar No 123, Blok A, Depan Warung Madura, RT 01 RW 02, Kelurahan Majasem, Kecamatan Kemang, Kabupaten Bogor"
                    class="w-full border border-[#E8DCC4] rounded-lg p-2 text-[#5C3D2E] focus:ring-1 focus:ring-[#C6584F] outline-none resize-none"
                  ></textarea>
                  
                  <!-- KOORDINAT (HIDDEN) -->
                  <input type="hidden" x-model="formData.lat">
                  <input type="hidden" x-model="formData.lng">
                  
                  <!-- STATUS LOKASI DENGAN DETAIL LENGKAP -->
                  <div x-show="formData.lat && formData.lng" class="text-sm bg-green-50 p-3 rounded-lg border border-green-200">
                    <div class="flex items-start gap-2">
                      <i class="fas fa-map-pin text-green-600 mt-1"></i>
                      <div>
                        <p class="font-bold text-green-700">Lokasi terdeteksi:</p>
                        <p class="text-green-600 font-mono text-sm" x-text="formData.lat.toFixed(6) + ', ' + formData.lng.toFixed(6)"></p>
                        <p class="text-xs text-gray-500 mt-2">
                          <i class="fas fa-info-circle mr-1"></i>
                          Silakan lengkapi alamat di atas dengan detail tambahan seperti nama jalan, nomor rumah, blok, RT/RW, kelurahan, dll.
                        </p>
                        <a x-bind:href="'https://www.google.com/maps?q=' + formData.lat + ',' + formData.lng" 
                           target="_blank" 
                           class="text-xs text-blue-600 hover:underline mt-1 inline-block">
                          <i class="fas fa-external-link-alt mr-1"></i>Lihat di Google Maps
                        </a>
                      </div>
                    </div>
                  </div>
                </section>

                <!-- Metode Pengiriman & Ongkir -->
                <section class="bg-white p-6 rounded-2xl border border-[#E8DCC4] shadow-sm space-y-4">
                  <h3 class="text-lg font-bold text-[#C6584F] border-b pb-2">Metode Pengiriman</h3>
                  
                  <div class="grid grid-cols-2 gap-3">
                    <!-- GoSend (Instant) -->
                    <div 
                      @click="selectShippingMethod('instant')"
                      :class="formData.shippingMethod === 'instant' ? 'border-[#758E27] bg-[#758E27]/10 ring-2 ring-[#758E27]' : 'border-gray-200 hover:border-gray-300'"
                      class="border-2 rounded-xl p-3 cursor-pointer transition-all text-center"
                    >
                      <div class="text-2xl mb-1">🛵</div>
                      <div class="font-bold text-sm">GoSend</div>
                      <div class="text-[10px] text-gray-500">Rp 2.500/km</div>
                    </div>
                    
                    <!-- Ambil Sendiri -->
                    <div 
                      @click="selectShippingMethod('pickup')"
                      :class="formData.shippingMethod === 'pickup' ? 'border-[#758E27] bg-[#758E27]/10 ring-2 ring-[#758E27]' : 'border-gray-200 hover:border-gray-300'"
                      class="border-2 rounded-xl p-3 cursor-pointer transition-all text-center"
                    >
                      <div class="text-2xl mb-1">🏠</div>
                      <div class="font-bold text-sm">Pickup</div>
                      <div class="text-[10px] text-gray-500">Gratis</div>
                    </div>
                  </div>
                  
                  <!-- Informasi Jarak & Ongkir -->
                  <div x-show="formData.shippingMethod !== 'pickup' && formData.distance" class="bg-[#FFF8EE] p-3 rounded-lg border border-[#E8DCC4] mt-2">
                    <div class="flex justify-between text-sm">
                      <span>Jarak dari toko:</span>
                      <span class="font-bold" x-text="formData.distance + ' km'"></span>
                    </div>
                    <div class="flex justify-between text-sm mt-1">
                      <span>Tarif GoSend:</span>
                      <span class="font-bold">Rp 2.500/km</span>
                    </div>
                    <div class="border-t border-[#E8DCC4] my-2 pt-2 flex justify-between font-bold">
                      <span>Total Ongkir:</span>
                      <span class="text-[#C6584F]" x-text="'Rp ' + shippingCost.toLocaleString('id-ID')"></span>
                    </div>
                  </div>
                  
                  <div x-show="formData.shippingMethod !== 'pickup' && !formData.lat" class="text-xs text-amber-600 bg-amber-50 p-2 rounded-lg">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    <span class="font-bold">Penting:</span> Ambil lokasi terlebih dahulu untuk menghitung ongkir!
                  </div>
                </section>
              </div>

              <div class="space-y-6">
                <!-- Metode Pembayaran QRIS - DENGAN GAMBAR PAYMENT1.JPEG -->
                <section class="bg-white p-6 rounded-2xl border border-[#E8DCC4] shadow-sm">
                  <h3 class="text-lg font-bold text-[#C6584F] mb-4">Metode Pembayaran (QRIS)</h3>
                  <div class="bg-[#FFF8EE] p-4 rounded-xl flex flex-col items-center border border-[#E8DCC4]">
                    <!-- GAMBAR QRIS DARI FILE Payment1.jpeg -->
                    <div class="w-48 h-48 bg-white p-2 rounded-lg shadow-inner mb-4 flex items-center justify-center">
                      <img src="{{ asset('assets/images/Payment1.jpeg') }}" alt="QRIS Payment" class="w-full h-full object-contain">
                    </div>
                    <p class="text-xs text-[#5C3D2E] text-center font-bold mb-4">SCAN DENGAN OVO, GOPAY, DANA, SHOPEEPAY, ATAU M-BANKING</p>
                    
                    <div class="w-full space-y-3">
                      <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Pengirim di Aplikasi</label>
                      <input 
                        type="text" 
                        required
                        x-model="formData.verificationName"
                        placeholder="Contoh: OVO an Budi"
                        class="w-full border border-[#E8DCC4] rounded-lg p-2 text-[#5C3D2E] focus:ring-1 focus:ring-[#C6584F] outline-none"
                      >
                      <label class="flex items-center gap-3 cursor-pointer">
                        <input 
                          type="checkbox" 
                          x-model="formData.agreedToVerify"
                          class="w-5 h-5 accent-[#C6584F]"
                        >
                        <span class="text-xs text-[#5C3D2E] font-medium leading-tight">
                          Saya akan konfirmasi via WhatsApp setelah transfer
                        </span>
                      </label>
                    </div>
                  </div>
                </section>

                <!-- Total Pembayaran -->
                <section class="bg-[#758E27] p-6 rounded-2xl text-white shadow-lg space-y-4">
                  <h3 class="text-xl font-bold">Total Pembayaran</h3>
                  <div class="space-y-2 opacity-90 text-sm">
                    <div class="flex justify-between">
                      <span>Total Belanja</span>
                      <span x-text="'Rp ' + subtotal.toLocaleString('id-ID')"></span>
                    </div>
                    <div class="flex justify-between">
                      <span>Ongkos Kirim</span>
                      <span x-text="shippingCost === 0 ? 'Gratis' : 'Rp ' + shippingCost.toLocaleString('id-ID')"></span>
                    </div>
                    <div class="border-t border-white/20 pt-2 flex justify-between text-xl font-bold">
                      <span>Total Akhir</span>
                      <span class="text-[#FBCB35]" x-text="'Rp ' + total.toLocaleString('id-ID')"></span>
                    </div>
                  </div>
                  
                  <!-- DEBUG INFO - HAPUS NANTI -->
                  <div class="text-xs text-white/70 bg-black/20 p-2 rounded mb-2">
                    <div>Valid: <span x-text="isFormValid ? '✅' : '❌'"></span></div>
                    <div>WhatsApp: <span x-text="formData.whatsapp ? '✅' : '❌'"></span></div>
                    <div>WA Error: <span x-text="whatsappError ? '❌' : '✅'"></span></div>
                    <div>Alamat: <span x-text="formData.address && formData.address.length > 10 ? '✅' : '❌'"></span></div>
                    <div>Nama Pengirim: <span x-text="formData.verificationName ? '✅' : '❌'"></span></div>
                    <div>Checkbox: <span x-text="formData.agreedToVerify ? '✅' : '❌'"></span></div>
                    <div x-show="formData.shippingMethod !== 'pickup'">Lokasi GoSend: <span x-text="formData.lat ? '✅' : '❌'"></span></div>
                  </div>
                  
                  <!-- TOMBOL KONFIRMASI -->
                  <button 
                    type="submit"
                    :disabled="submitting || !isFormValid"
                    class="w-full bg-[#C6584F] text-white py-4 rounded-xl font-bold text-lg hover:bg-[#b04d45] shadow-md transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                  >
                    <span x-show="!submitting">KONFIRMASI PESANAN</span>
                    <span x-show="submitting"><i class="fas fa-spinner fa-spin mr-2"></i> Memproses...</span>
                  </button>
                </section>
              </div>
            </form>
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- PAYMENT PAGE SCRIPT - VERSI TERBARU DENGAN DEBUG -->
  <script>
    function paymentPage() {
      return {
        loading: true,
        submitting: false,
        cart: [],
        subtotal: 0,
        total: 0,
        shippingCost: 0,
        
        // Koordinat toko BARU (Purbalingga)
        storeLat: -7.372085370419896,
        storeLng: 109.24156771402993,
        
        formData: {
          name: '{{ auth()->user()->name ?? "Customer Bunda" }}',
          email: '{{ auth()->user()->email ?? "customer@gmail.com" }}',
          whatsapp: '',
          address: '',
          lat: null,
          lng: null,
          distance: 0,
          shippingMethod: 'pickup',
          verificationName: '',
          agreedToVerify: false
        },
        
        whatsappError: '',
        
        init() {
          this.loadData();
        },
        
        loadData() {
          // AMBIL DATA USER DARI SERVER JIKA LOGIN
          @auth
            this.formData.name = '{{ auth()->user()->name }}';
            this.formData.email = '{{ auth()->user()->email }}';
          @endauth
          
          // AMBIL CART DARI LOCALSTORAGE
          const savedCart = localStorage.getItem('cart');
          if (savedCart) {
            try {
              this.cart = JSON.parse(savedCart);
              this.calculateSubtotal();
              
              // SYNC CART KE SESSION SERVER
              this.syncCartToSession();
            } catch (e) {
              console.error('Error parsing cart:', e);
            }
          }
          
          // CEK APAKAH KERANJANG KOSONG
          if (this.cart.length === 0) {
            window.location.href = '{{ route('order.cart') }}';
          }
          
          this.loading = false;
        },
        
        // COMPUTED PROPERTY - CEK APAKAH FORM VALID
        get isFormValid() {
          // Cek WhatsApp (harus ada dan tidak error)
          if (!this.formData.whatsapp || this.whatsappError) {
            console.log('Validasi gagal: WhatsApp', this.formData.whatsapp, this.whatsappError);
            return false;
          }
          
          // Cek Alamat (minimal 10 karakter)
          if (!this.formData.address || this.formData.address.trim().length < 10) {
            console.log('Validasi gagal: Alamat terlalu pendek');
            return false;
          }
          
          // Cek Nama Pengirim
          if (!this.formData.verificationName || this.formData.verificationName.trim() === '') {
            console.log('Validasi gagal: Nama pengirim kosong');
            return false;
          }
          
          // Cek Persetujuan
          if (!this.formData.agreedToVerify) {
            console.log('Validasi gagal: Checkbox tidak dicentang');
            return false;
          }
          
          // Cek Lokasi untuk GoSend
          if (this.formData.shippingMethod !== 'pickup' && !this.formData.lat) {
            console.log('Validasi gagal: Lokasi GoSend belum diambil');
            return false;
          }
          
          console.log('Validasi sukses!');
          return true;
        },
        
        // SYNC CART KE SESSION SERVER
        syncCartToSession() {
          fetch('{{ route('order.sync-cart') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ cart: this.cart })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              console.log('Cart synced to session');
            } else {
              console.error('Sync failed:', data.error);
            }
          })
          .catch(error => console.error('Sync error:', error));
        },
        
        calculateSubtotal() {
          this.subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
          this.calculateTotal();
        },
        
        calculateTotal() {
          this.total = this.subtotal + this.shippingCost;
        },
        
        // VALIDASI WHATSAPP - HANYA ANGKA
        validateWhatsApp() {
          const wa = this.formData.whatsapp;
          
          // Hapus semua karakter non-digit
          const digitsOnly = wa.replace(/\D/g, '');
          
          // Update value dengan hanya angka
          this.formData.whatsapp = digitsOnly;
          
          // Validasi panjang minimal
          if (digitsOnly.length > 0 && digitsOnly.length < 10) {
            this.whatsappError = 'Nomor WhatsApp minimal 10 digit';
          } else if (digitsOnly.length > 15) {
            this.whatsappError = 'Nomor WhatsApp maksimal 15 digit';
          } else {
            this.whatsappError = '';
          }
        },
        
        selectShippingMethod(method) {
          this.formData.shippingMethod = method;
          
          if (method === 'pickup') {
            this.shippingCost = 0;
            this.calculateTotal();
          } else if (this.formData.lat && this.formData.lng) {
            this.calculateShipping();
          }
        },
        
        calculateShipping() {
          if (!this.formData.lat || !this.formData.lng) return;
          
          // PASTIKAN SEMUA NILAI ADALAH FLOAT
          const lat1 = parseFloat(this.storeLat);
          const lon1 = parseFloat(this.storeLng);
          const lat2 = parseFloat(this.formData.lat);
          const lon2 = parseFloat(this.formData.lng);
          
          // Rumus Haversine
          const R = 6371; // Radius bumi dalam km
          const dLat = this.deg2rad(lat2 - lat1);
          const dLon = this.deg2rad(lon2 - lon1);
          const a = 
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) * 
            Math.sin(dLon/2) * Math.sin(dLon/2);
          const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
          const distance = R * c;
          
          // BULATKAN JARAK (2 desimal)
          this.formData.distance = parseFloat((Math.round(distance * 100) / 100).toFixed(2));
          
          // Hitung ongkir (HANYA INSTANT/GoSend)
          let rate = 2500;
          let cost = Math.ceil(this.formData.distance * rate);
          
          // Minimal ongkir Rp 10.000
          if (cost < 10000) cost = 10000;
          
          this.shippingCost = parseFloat(cost);
          this.calculateTotal();
        },
        
        deg2rad(deg) {
          return deg * (Math.PI/180);
        },
        
        getCurrentLocation() {
          if (navigator.geolocation) {
            this.showNotification('Mendapatkan lokasi...', 'info');
            
            navigator.geolocation.getCurrentPosition(
              (position) => {
                // PASTIKAN FLOAT
                this.formData.lat = parseFloat(position.coords.latitude);
                this.formData.lng = parseFloat(position.coords.longitude);
                
                // Set alamat awal dengan koordinat (customer akan melengkapi)
                if (!this.formData.address || this.formData.address.trim() === '') {
                  this.formData.address = `Koordinat: ${this.formData.lat.toFixed(6)}, ${this.formData.lng.toFixed(6)}\n\nSilakan lengkapi alamat detail di sini...`;
                }
                
                if (this.formData.shippingMethod !== 'pickup') {
                  this.calculateShipping();
                }
                
                this.showNotification('Lokasi berhasil didapatkan! Silakan lengkapi alamat detail.', 'success');
              },
              (error) => {
                let message = "Gagal mendapatkan lokasi. ";
                switch(error.code) {
                  case error.PERMISSION_DENIED:
                    message += "Izin lokasi ditolak. Silakan izinkan akses lokasi di browser Anda.";
                    break;
                  case error.POSITION_UNAVAILABLE:
                    message += "Informasi lokasi tidak tersedia.";
                    break;
                  case error.TIMEOUT:
                    message += "Waktu permintaan lokasi habis. Coba lagi.";
                    break;
                }
                this.showNotification(message, 'error');
              },
              {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
              }
            );
          } else {
            this.showNotification("Browser tidak mendukung geolocation", 'error');
          }
        },
        
        submitForm() {
          // VALIDASI LENGKAP
          if (!this.isFormValid) {
            alert('Harap lengkapi semua data dengan benar');
            return;
          }
          
          this.submitting = true;
          this.showNotification('Memproses pesanan...', 'info');
          
          // PASTIKAN SEMUA DATA DI-PARSE DENGAN BENAR
          const postData = {
            nama: this.formData.name,
            email: this.formData.email,
            telepon: this.formData.whatsapp,
            alamat: this.formData.address,
            lat: parseFloat(this.formData.lat) || 0,
            lng: parseFloat(this.formData.lng) || 0,
            jarak: parseFloat(this.formData.distance) || 0,
            shipping_method: this.formData.shippingMethod,
            shipping_cost: parseFloat(this.shippingCost) || 0,
            metode_pembayaran: 'qris',
            nama_pengirim: this.formData.verificationName
          };
          
          console.log('📤 Sending data to payment.process:', postData);
          
          // KIRIM DATA KE PAYMENT PROCESS
          fetch('{{ route('order.payment.process') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(postData)
          })
          .then(response => {
            console.log('📥 Payment.process response status:', response.status);
            if (!response.ok) {
              return response.text().then(text => {
                throw new Error(`HTTP error ${response.status}: ${text}`);
              });
            }
            return response.json();
          })
          .then(data => {
            console.log('📦 Payment.process data:', data);
            if (data.success) {
              this.showNotification('Data berhasil disimpan, membuat pesanan...', 'success');
              
              // SETELAH PAYMENT PROCESS BERHASIL, KIRIM KE ORDER PROCESS
              const orderFormData = new FormData();
              orderFormData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
              
              console.log('📤 Sending to order.process...');
              
              // KIRIM KE ROUTE ORDER.PROCESS
              fetch('{{ route('order.order.process') }}', {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: orderFormData
              })
              .then(response => {
                console.log('📥 Order.process response status:', response.status);
                if (response.redirected) {
                  console.log('➡️ Redirected to:', response.url);
                  window.location.href = response.url;
                } else {
                  return response.json().then(data => {
                    console.log('📦 Order.process data:', data);
                    if (data && data.success) {
                      window.location.href = '/order/invoice/' + data.invoice;
                    } else {
                      throw new Error(data?.error || 'Unknown error');
                    }
                  });
                }
              })
              .catch(error => {
                console.error('❌ Error in order.process:', error);
                alert('Terjadi kesalahan saat membuat pesanan: ' + error.message);
                this.submitting = false;
              });
              
            } else {
              alert('Gagal memproses data: ' + (data.error || 'Unknown error'));
              this.submitting = false;
            }
          })
          .catch(error => {
            console.error('❌ Error in payment.process:', error);
            alert('Terjadi kesalahan koneksi: ' + error.message);
            this.submitting = false;
          });
        },
        
        showNotification(message, type = 'success') {
          const colors = {
            success: '#6B8E23',
            error: '#C6584F',
            info: '#3498db'
          };
          
          const notif = document.createElement('div');
          notif.className = 'fixed top-4 right-4 text-white px-6 py-3 rounded-full font-fredoka z-[100000] shadow-lg animate-bounce';
          notif.style.backgroundColor = colors[type] || colors.info;
          
          let icon = '';
          if (type === 'success') icon = '✓';
          if (type === 'error') icon = '✗';
          if (type === 'info') icon = 'ℹ';
          
          notif.innerHTML = `${icon} ${message}`;
          document.body.appendChild(notif);
          
          setTimeout(() => {
            notif.style.opacity = '0';
            notif.style.transition = 'opacity 0.3s';
            setTimeout(() => notif.remove(), 300);
          }, 5000);
        }
      }
    }
  </script>

  <style>
    [x-cloak] { display: none !important; }
  </style>

</body>
</html>