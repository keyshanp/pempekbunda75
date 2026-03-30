<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang - PempekBunda 75</title>

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
  <link href="https://fonts.googleapis.com/css2?family=Itim&family=Fredoka:wght@300..700&family=Bubblegum+Sans&display=swap" rel="stylesheet">
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  
  <style>
    body {
      font-family: 'Itim', cursive;
      background-color: #fff9f0;
      color: #4a3728;
    }
    
    .font-bubble {
      font-family: 'Bubblegum Sans', cursive;
    }
    
    .font-fredoka {
      font-family: 'Fredoka', sans-serif;
    }
    
    .text-outline {
      -webkit-text-stroke: 1px #BC5A45;
      color: transparent;
    }
    
    .quantity-btn {
      width: 2rem;
      height: 2rem;
      border-radius: 9999px;
      background-color: #BC5A45;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .quantity-btn:hover {
      background-color: #a34d3b;
      transform: scale(1.1);
    }
    
    .remove-btn {
      color: #BC5A45;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .remove-btn:hover {
      color: #a34d3b;
      transform: scale(1.1);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col" x-data="cartPage()" x-init="loadCart()">

  <!-- NAVBAR -->
  <nav class="flex justify-between items-center px-6 py-8 md:px-12 max-w-6xl mx-auto w-full">
    <div class="text-3xl font-bubble text-[#BC5A45] flex flex-col leading-tight">
      <span>Pempek</span>
      <span class="ml-4">Bunda 75</span>
    </div>
    
    <div class="hidden md:flex space-x-8 text-lg items-center">
      <a href="{{ route('home') }}" class="hover:underline decoration-2">home</a>
      <a href="{{ route('home') }}#produk" class="hover:underline decoration-2">produk</a>
      <a href="{{ route('order.my-orders') }}" class="hover:underline decoration-2">cek pesanan</a>
      <a href="{{ route('order.index') }}" class="bg-[#BC5A45] text-white px-6 py-1 rounded-full hover:opacity-90 transition-opacity">
        + order lagi
      </a>
    </div>

    <div class="md:hidden">
      <button class="text-[#BC5A45] text-2xl">☰</button>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main class="flex-grow px-6 md:px-12 max-w-6xl mx-auto py-12 w-full">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
      <h1 class="text-6xl md:text-8xl font-rascal mb-4 md:mb-0" style="color: #4a3728;">Keranjangmu</h1>
      <a href="{{ route('order.index') }}" class="text-[#BC5A45] font-bubble text-xl hover:underline">
        ← Lanjut Belanja
      </a>
    </div>

    <!-- CART CONTENT -->
    <template x-if="cart.length === 0">
      <div class="text-center py-20">
        <div class="text-9xl mb-6">🛒</div>
        <h2 class="text-3xl font-bubble text-[#6B8E23] mb-4">Keranjangmu masih kosong</h2>
        <p class="font-fredoka text-lg mb-8">Yuk, tambah menu favoritmu!</p>
        <a href="{{ route('order.index') }}" class="inline-block bg-[#BC5A45] text-white font-bubble text-xl px-10 py-4 rounded-full hover:bg-[#a34d3b] transition-all">
          Lihat Menu
        </a>
      </div>
    </template>

    <template x-if="cart.length > 0">
      <div class="flex flex-col lg:flex-row gap-12">
        <!-- Cart Items -->
        <div class="lg:w-2/3 space-y-6">
          <template x-for="(item, index) in cart" :key="item.id">
            <div class="bg-white rounded-3xl p-6 shadow-lg border-2 border-[#6B8E23] flex flex-col sm:flex-row gap-6">
              <!-- Product Image -->
              <div class="sm:w-32 h-32 rounded-2xl overflow-hidden border-4 border-[#BC5A45]">
                <img :src="item.image" :alt="item.name" class="w-full h-full object-cover">
              </div>
              
              <!-- Product Details -->
              <div class="flex-1">
                <h3 class="text-2xl font-bubble text-[#BC5A45]" x-text="item.name"></h3>
                <p class="text-xl font-fredoka font-semibold text-[#6B8E23] mb-4" x-text="'Rp ' + item.price.toLocaleString('id-ID')"></p>
                
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-4">
                    <button class="quantity-btn" @click="updateQuantity(index, item.quantity - 1)" :disabled="item.quantity <= 1">-</button>
                    <span class="text-xl font-bold min-w-[2rem] text-center" x-text="item.quantity"></span>
                    <button class="quantity-btn" @click="updateQuantity(index, item.quantity + 1)">+</button>
                  </div>
                  <button class="remove-btn text-2xl" @click="removeItem(index)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </div>
              
              <!-- Subtotal -->
              <div class="sm:text-right">
                <p class="text-sm font-fredoka opacity-60">Subtotal</p>
                <p class="text-2xl font-bubble text-[#BC5A45]" x-text="'Rp ' + (item.price * item.quantity).toLocaleString('id-ID')"></p>
              </div>
            </div>
          </template>
        </div>

        <!-- Order Summary -->
        <div class="lg:w-1/3">
          <div class="bg-[#6B8E23] text-white rounded-3xl p-8 sticky top-32">
            <h3 class="text-3xl font-bubble mb-6">Ringkasan</h3>
            
            <div class="space-y-4 font-fredoka mb-8">
              <div class="flex justify-between">
                <span>Subtotal</span>
                <span class="font-bold" x-text="'Rp ' + subtotal.toLocaleString('id-ID')"></span>
              </div>
              <div class="flex justify-between">
                <span>Ongkir</span>
                <span class="font-bold" x-text="ongkir === 0 ? 'GRATIS' : 'Rp ' + ongkir.toLocaleString('id-ID')"></span>
              </div>
              <div class="border-t border-white/20 pt-4 flex justify-between text-xl">
                <span class="font-bubble">Total</span>
                <span class="font-bubble text-[#BC5A45]" x-text="'Rp ' + total.toLocaleString('id-ID')"></span>
              </div>
            </div>

            <a 
              href="{{ route('order.checkout') }}" 
              class="block w-full bg-[#BC5A45] text-white text-center font-bubble text-xl py-4 rounded-2xl hover:bg-[#a34d3b] transition-all shadow-lg"
            >
              LANJUT KE PEMBAYARAN →
            </a>
            
            <p class="text-xs text-center mt-4 opacity-60">
              *Ongkir gratis untuk pembelian minimal Rp 100.000
            </p>
          </div>
        </div>
      </div>
    </template>

  </main>

  <!-- FOOTER -->
  <footer class="bg-[#4a3728] text-[#FFF9F0] py-20 px-6 md:px-12 border-t-[10px] border-[#BC5A45]">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-16">
      <div class="space-y-6">
        <div class="text-4xl font-bubble text-[#BC5A45] font-rascal">
          Pempek<br />Bunda 75
        </div>
        <p class="font-fredoka text-sm opacity-80 leading-relaxed">
          Membawa cita rasa asli Palembang ke meja makan Anda sejak 2019. Kualitas adalah janji kami.
        </p>
      </div>
      
      <div class="space-y-4">
        <h4 class="text-xl font-bubble text-[#6B8E23]">Kontak Kami</h4>
        <ul class="space-y-2 font-fredoka opacity-90">
          <li>WhatsApp: +62 812-3456-789</li>
          <li>Instagram: @pempekbunda75</li>
          <li>Email: halo@pempekbunda75.com</li>
        </ul>
      </div>

      <div class="space-y-4">
        <h4 class="text-xl font-bubble text-[#BC5A45]">Lokasi</h4>
        <p class="font-fredoka opacity-90 text-sm">
          Jl. Kenangan Indah No. 75,<br />
          Kota Palembang, Sumatera Selatan
        </p>
        <div class="text-3xl text-[#6B8E23]">★ ★ ★ ★ ★</div>
      </div>
    </div>
    <div class="max-w-6xl mx-auto mt-16 pt-8 border-t border-white/10 text-center font-fredoka text-xs opacity-50">
      © 2019 PempekBunda 75. HANDCRAFTED WITH LOVE.
    </div>
  </footer>

  <script>
    function cartPage() {
      return {
        cart: [],
        subtotal: 0,
        ongkir: 15000,
        total: 0,
        
        loadCart() {
          const savedCart = localStorage.getItem('cart');
          if (savedCart) {
            this.cart = JSON.parse(savedCart);
            this.calculateTotals();
          }
        },
        
        calculateTotals() {
          this.subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
          this.ongkir = this.subtotal >= 100000 ? 0 : 15000;
          this.total = this.subtotal + this.ongkir;
          
          // Update localStorage
          localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        
        updateQuantity(index, newQuantity) {
          if (newQuantity < 1) return;
          this.cart[index].quantity = newQuantity;
          this.calculateTotals();
        },
        
        removeItem(index) {
          this.cart.splice(index, 1);
          this.calculateTotals();
          
          if (this.cart.length === 0) {
            localStorage.removeItem('cart');
          }
        }
      }
    }
  </script>

</body>
</html>
