<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang - Pempek Bunda 75</title>

  <!-- CSRF Token - PENTING UNTUK AJAX -->
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
  
  <!-- Alpine.js untuk keranjang - Gunakan versi spesifik -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>
  
  <style>
    html {
      scroll-behavior: smooth;
      scroll-padding-top: 100px;
    }
    
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: #FFF8EE;
      color: #5C3D2E;
      margin: 0;
      padding: 0;
    }
    
    .font-handwritten {
      font-family: 'Coming Soon', cursive;
    }
    
    .font-reenie {
      font-family: 'Reenie Beanie', cursive;
    }
    
    .custom-shadow {
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
    }

    .animate-fade-in {
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    [x-cloak] { display: none !important; }
    .animate-bounce {
      animation: bounce 1s infinite;
    }
    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }
  </style>
</head>
<body x-data="cartPage()" x-init="loadCart()" class="min-h-screen flex flex-col" style="padding-top: 0;">

  <!-- MAIN CONTENT - TANPA HEADER, LANGSUNG MULAI DARI SINI -->
  <main class="flex-grow" style="padding: 40px 20px; max-width: 1200px; margin-left: auto; margin-right: auto; width: 100%;">

    <div class="animate-fade-in">
      <div class="flex justify-between items-baseline mb-12">
        <!-- TITLE MENGGUNAKAN FONT RASCAL -->
        <h2 class="text-8xl md:text-9xl font-rascal text-[#5C3D2E] tracking-tight" style="color: #7c2d12; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Keranjangmu</h2>
        <!-- LINK LANJUT BELANJA MENGGUNAKAN FONT REENIE -->
        <a href="{{ route('order.index') }}" class="text-[#C6584F] font-reenie text-3xl flex items-center gap-2 hover:underline">
          ← Lanjut Belanja
        </a>
      </div>

      <!-- Tampilan ketika keranjang kosong -->
      <div x-show="cart.length === 0" x-cloak class="flex flex-col items-center justify-center py-20 text-[#5C3D2E]">
        <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
        <h2 class="text-2xl font-bold mb-4">Keranjang Kosong</h2>
        <a href="{{ route('order.index') }}" class="text-[#C6584F] underline font-reenie text-2xl">Mulai Belanja</a>
      </div>

      <!-- Tampilan ketika keranjang ada isi -->
      <div x-show="cart.length > 0" x-cloak>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Cart List -->
          <div class="lg:col-span-2 space-y-4">
            <template x-for="(item, index) in cart" :key="item.id">
              <div class="bg-white rounded-2xl p-4 flex items-center gap-6 border border-[#E8DCC4] shadow-sm">
                <img x-bind:src="item.image" x-bind:alt="item.name" onerror="this.src='{{ asset('assets/images/Pempek.png') }}'" class="w-24 h-24 rounded-xl object-cover">
                <div class="flex-grow">
                  <div class="flex justify-between items-start">
                    <div>
                      <h3 class="text-[#C6584F] text-xl font-bold" x-text="item.name"></h3>
                      <p class="text-[#5C3D2E] font-medium" x-text="'Rp ' + item.price.toLocaleString('id-ID')"></p>
                    </div>
                    <div class="text-right">
                      <span class="text-xs text-gray-400 block uppercase">Subtotal</span>
                      <span class="text-[#C6584F] text-xl font-bold" x-text="'Rp ' + (item.price * item.quantity).toLocaleString('id-ID')"></span>
                    </div>
                  </div>
                  
                  <div class="flex items-center gap-4 mt-4">
                    <div class="flex items-center gap-3">
                      <button 
                        @click="updateQuantity(index, item.quantity - 1)"
                        class="w-8 h-8 rounded-full bg-[#C6584F] text-white flex items-center justify-center text-xl font-bold hover:opacity-80"
                        :disabled="item.quantity <= 1"
                      >
                        -
                      </button>
                      <span class="text-[#5C3D2E] font-bold w-4 text-center" x-text="item.quantity"></span>
                      <button 
                        @click="updateQuantity(index, item.quantity + 1)"
                        class="w-8 h-8 rounded-full bg-[#C6584F] text-white flex items-center justify-center text-xl font-bold hover:opacity-80"
                      >
                        +
                      </button>
                    </div>
                    <button 
                      @click="removeItem(index)"
                      class="ml-auto text-gray-400 hover:text-red-500 transition-colors"
                      title="Hapus item"
                    >
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </div>
              </div>
            </template>
          </div>

          <!-- SUMMARY CARD -->
          <div class="bg-[#758E27] rounded-[2rem] p-8 text-white h-fit shadow-lg sticky top-8">
            <h3 class="text-3xl font-bold mb-8">Ringkasan</h3>
            
            <div class="space-y-4 mb-8">
              <div class="flex justify-between items-center opacity-90">
                <span>Subtotal</span>
                <span class="font-bold uppercase" x-text="'Rp ' + subtotal.toLocaleString('id-ID')"></span>
              </div>
              <!-- 🔥 HAPUS BAGIAN ONGKIR 🔥 -->
              <!-- <div class="flex justify-between items-center opacity-90">
                <span>Ongkir</span>
                <span class="font-bold uppercase" x-text="shipping === 0 ? 'GRATIS' : 'Rp ' + shipping.toLocaleString('id-ID')"></span>
              </div> -->
              <hr class="border-white/20 my-4">
              <div class="flex justify-between items-center text-2xl font-bold">
                <span>Total</span>
                <span class="text-[#FBCB35]" x-text="'Rp ' + subtotal.toLocaleString('id-ID')"></span>
              </div>
            </div>
            
            <!-- TOMBOL DIPAKSA PAKAI JAVASCRIPT -->
            @auth
              <button 
                id="payment-button"
                class="w-full bg-[#C6584F] text-white py-4 rounded-xl font-bold text-lg hover:bg-[#b04d45] transition-all flex items-center justify-center gap-2 group cursor-pointer"
              >
                LANJUT KE PEMBAYARAN
                <span class="group-hover:translate-x-1 transition-transform">→</span>
              </button>
            @else
              <button 
                id="login-button"
                class="w-full bg-[#C6584F] text-white py-4 rounded-xl font-bold text-lg hover:bg-[#b04d45] transition-all flex items-center justify-center gap-2 group cursor-pointer"
              >
                LOGIN DULU
                <span class="group-hover:translate-x-1 transition-transform">→</span>
              </button>
              <p class="text-xs text-center mt-2 opacity-80">Silakan login untuk melanjutkan ke pembayaran</p>
            @endauth
            
            <!-- 🔥 HAPUS TEKS ONGKIR GRATIS 🔥 -->
            <!-- <p class="text-[10px] text-center mt-4 opacity-70 italic">
              *Ongkir gratis untuk pembelian minimal Rp 100.000
            </p> -->
          </div>
        </div>
      </div>
    </div>

  </main>

  <!-- TIDAK ADA FOOTER DI SINI -->

  <!-- ALPINE.JS SCRIPT -->
  <script>
    function cartPage() {
      return {
        cart: [],
        subtotal: 0,
        
        loadCart() {
          const savedCart = localStorage.getItem('cart');
          if (savedCart) {
            try {
              this.cart = JSON.parse(savedCart);
              this.calculateTotals();
              console.log('Cart loaded:', this.cart);
            } catch (e) {
              console.error('Error parsing cart:', e);
              this.cart = [];
            }
          }
        },
        
        calculateTotals() {
          this.subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
          localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        
        updateQuantity(index, newQuantity) {
          if (newQuantity < 1) {
            this.cart.splice(index, 1);
          } else {
            this.cart[index].quantity = newQuantity;
          }
          this.calculateTotals();
        },
        
        removeItem(index) {
          this.cart.splice(index, 1);
          this.calculateTotals();
        }
      }
    }
  </script>

  <!-- SCRIPT KHUSUS UNTUK TOMBOL PAYMENT -->
  <script>
    // Fungsi untuk menampilkan notifikasi
    function showNotification(message, type = 'success') {
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
      }, 3000);
    }

    // Fungsi untuk sync cart ke session
    function syncCartToSession(cart) {
      return fetch('{{ route('order.sync-cart') }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ cart: cart })
      })
      .then(response => response.json());
    }

    // Eksekusi setelah DOM siap
    document.addEventListener('DOMContentLoaded', function() {
      console.log('DOM loaded - Mencari tombol payment');
      
      @auth
        console.log('User is logged in - Mencari tombol payment');
        
        const paymentBtn = document.getElementById('payment-button');
        if (paymentBtn) {
          console.log('✅ Tombol payment DITEMUKAN');
          
          paymentBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('🖱️ Tombol payment DIKLIK');
            
            // Ambil cart dari localStorage
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            console.log('Cart items:', cart.length);
            
            if (cart.length === 0) {
              showNotification('Keranjang belanja masih kosong', 'error');
              setTimeout(() => {
                window.location.href = '{{ route('order.index') }}';
              }, 1500);
              return;
            }
            
            // Tampilkan loading
            paymentBtn.disabled = true;
            paymentBtn.innerHTML = '<span class="animate-pulse">⏳ Memproses...</span>';
            
            // Sync cart ke session dulu
            syncCartToSession(cart)
              .then(data => {
                console.log('Sync result:', data);
                if (data.success) {
                  showNotification('Berhasil, mengalihkan ke pembayaran...', 'success');
                  // Redirect ke payment
                  window.location.href = '{{ route('order.payment') }}';
                } else {
                  showNotification('Gagal sync: ' + (data.error || 'Unknown error'), 'error');
                  paymentBtn.disabled = false;
                  paymentBtn.innerHTML = 'LANJUT KE PEMBAYARAN →';
                }
              })
              .catch(error => {
                console.error('Error:', error);
                showNotification('Error koneksi, tetap mencoba redirect...', 'info');
                // Tetap redirect walaupun error
                window.location.href = '{{ route('order.payment') }}';
              });
          });
        } else {
          console.error('❌ Tombol payment TIDAK DITEMUKAN!');
        }
      @else
        console.log('User is NOT logged in - Mencari tombol login');
        
        const loginBtn = document.getElementById('login-button');
        if (loginBtn) {
          console.log('✅ Tombol login DITEMUKAN');
          
          loginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('🖱️ Tombol login DIKLIK');
            
            // Simpan cart dulu
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length > 0) {
              // Sync cart ke session sebelum login
              syncCartToSession(cart)
                .then(() => {
                  // Simpan redirect URL
                  localStorage.setItem('redirect_after_login', '{{ route('order.payment') }}');
                  window.location.href = '{{ route('login') }}';
                })
                .catch(() => {
                  localStorage.setItem('redirect_after_login', '{{ route('order.payment') }}');
                  window.location.href = '{{ route('login') }}';
                });
            } else {
              localStorage.setItem('redirect_after_login', '{{ route('order.payment') }}');
              window.location.href = '{{ route('login') }}';
            }
          });
        } else {
          console.error('❌ Tombol login TIDAK DITEMUKAN!');
        }
      @endauth
    });

    // FUNGSI DEBUG
    window.debugCart = function() {
      console.log('=== DEBUG CART ===');
      console.log('Cart localStorage:', JSON.parse(localStorage.getItem('cart') || '[]'));
      console.log('Payment route:', '{{ route('order.payment') }}');
      console.log('Login route:', '{{ route('login') }}');
      console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]')?.content);
      
      // Test route payment
      fetch('{{ route('order.payment') }}', { 
        method: 'HEAD',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(response => {
        console.log('Payment route status:', response.status);
        console.log('Payment route URL:', response.url);
        if (response.url.includes('login')) {
          console.log('⚠️ Redirected to login - User not authenticated');
        } else {
          console.log('✅ Payment route accessible');
        }
      })
      .catch(error => console.error('Error testing payment route:', error));
    };

    console.log('Gunakan debugCart() untuk debugging di console');
  </script>

</body>
</html>