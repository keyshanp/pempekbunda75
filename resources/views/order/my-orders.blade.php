<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesanan Saya - PempekBunda 75</title>

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
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
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

    /* ===== STATUS BADGES ===== */
    .status-badge {
      display: inline-block;
      padding: 5px 12px;
      border-radius: 50px;
      font-size: 14px;
      font-weight: bold;
      font-family: 'Fredoka', sans-serif;
    }

    .status-pending {
      background-color: #fef3c7;
      color: #92400e;
    }

    .status-waiting {
      background-color: #dbeafe;
      color: #1e40af;
    }

    .status-processing {
      background-color: #e0f2fe;
      color: #0369a1;
    }

    .status-ready {
      background-color: #d1fae5;
      color: #065f46;
    }

    .status-shipping {
      background-color: #ede9fe;
      color: #5b21b6;
    }

    .status-completed {
      background-color: #dcfce7;
      color: #166534;
    }

    .status-cancelled {
      background-color: #fee2e2;
      color: #991b1b;
    }

    /* ===== TIMELINE ===== */
    .timeline {
      position: relative;
      padding-left: 30px;
    }

    .timeline::before {
      content: '';
      position: absolute;
      left: 10px;
      top: 0;
      bottom: 0;
      width: 2px;
      background: #e0e0e0;
    }

    .timeline-item {
      position: relative;
      padding-bottom: 20px;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: -30px;
      top: 0;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #e0e0e0;
      border: 3px solid white;
      z-index: 2;
    }

    .timeline-item.completed::before {
      background: #6B8E23;
    }

    .timeline-item.active::before {
      background: #BC5A45;
      box-shadow: 0 0 0 3px rgba(188, 90, 69, 0.2);
    }

    .timeline-item .timeline-content {
      padding-left: 15px;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <!-- HEADER -->
  <header class="header">
    <div class="logo-container">
      <a href="{{ route('home') }}" class="logo-link">
        <img src="{{ asset('assets/images/logobrand.png') }}" alt="PempekBunda 75 Logo" class="brand-logo">
      </a>
    </div>
    <!-- Desktop Nav -->
    <div class="header-right" id="desktop-nav-myorders">
      <nav class="nav">
        <a href="{{ route('home') }}" class="nav-link">home</a>
        <a href="{{ route('order.index') }}" class="nav-link">produk</a>
        <a href="{{ route('order.my-orders') }}" class="nav-link active">cek pesanan</a>
      </nav>
      <a href="{{ route('order.index') }}" class="btn-header">order</a>
    </div>
    <!-- Hamburger -->
    <button id="hamburger-myorders" aria-label="Buka menu" style="display:none; background:none; border:none; cursor:pointer; padding:8px;">
      <svg id="icon-open-myorders" width="28" height="28" fill="none" stroke="#7c2d12" stroke-width="2.5" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      <svg id="icon-close-myorders" width="28" height="28" fill="none" stroke="#7c2d12" stroke-width="2.5" viewBox="0 0 24 24" style="display:none;"><line x1="4" y1="4" x2="20" y2="20"/><line x1="20" y1="4" x2="4" y2="20"/></svg>
    </button>
  </header>

  <!-- Mobile Menu -->
  <div id="mobile-nav-myorders" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(255,255,255,0.98); z-index:999998; flex-direction:column; align-items:center; justify-content:center; gap:32px;">
    <a href="{{ route('home') }}" class="nav-link" style="font-size:2rem;" onclick="closeMobileMyOrders()">home</a>
    <a href="{{ route('order.index') }}" class="nav-link" style="font-size:2rem;" onclick="closeMobileMyOrders()">produk</a>
    <a href="{{ route('order.my-orders') }}" class="nav-link" style="font-size:2rem; color:#c97b63;" onclick="closeMobileMyOrders()">cek pesanan</a>
    <a href="{{ route('order.index') }}" class="btn-header" style="font-size:1.5rem; margin-top:8px;" onclick="closeMobileMyOrders()">order</a>
  </div>

  <style>
    @media (max-width: 768px) {
      #desktop-nav-myorders { display: none !important; }
      #hamburger-myorders { display: block !important; }
    }
  </style>
  <script>
    document.getElementById('hamburger-myorders').addEventListener('click', function() {
      const nav = document.getElementById('mobile-nav-myorders');
      const isOpen = nav.style.display === 'flex';
      nav.style.display = isOpen ? 'none' : 'flex';
      document.getElementById('icon-open-myorders').style.display = isOpen ? 'block' : 'none';
      document.getElementById('icon-close-myorders').style.display = isOpen ? 'none' : 'block';
    });
    function closeMobileMyOrders() {
      document.getElementById('mobile-nav-myorders').style.display = 'none';
      document.getElementById('icon-open-myorders').style.display = 'block';
      document.getElementById('icon-close-myorders').style.display = 'none';
    }
  </script>

  <!-- MAIN CONTENT -->
  <main class="flex-grow" style="margin-top: 80px; padding: 40px 20px; max-width: 1200px; margin-left: auto; margin-right: auto; width: 100%;">

    <h1 class="text-5xl md:text-6xl font-rascal text-center mb-8" style="color: #7c2d12;">Pesanan Saya</h1>

    <!-- Status Filter Tabs -->
    <div class="flex flex-wrap gap-2 justify-center mb-8">
      <button class="px-4 py-2 rounded-full bg-[#6B8E23] text-white font-bubble text-lg">Semua</button>
      <button class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 font-bubble text-lg hover:bg-gray-300">Menunggu</button>
      <button class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 font-bubble text-lg hover:bg-gray-300">Diproses</button>
      <button class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 font-bubble text-lg hover:bg-gray-300">Selesai</button>
    </div>

    <!-- Orders List (Sample Data) -->
    <div class="space-y-6">
      <!-- Order Item 1 -->
      <div class="bg-white rounded-3xl shadow-lg p-6 border-2 border-[#6B8E23] hover:shadow-xl transition">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
          <div>
            <span class="font-bubble text-2xl text-[#BC5A45]">INV/PB/20260214/0001</span>
            <p class="font-fredoka text-sm text-gray-500">14 Februari 2026 • 14:30</p>
          </div>
          <span class="status-badge status-pending">Menunggu Pembayaran</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <p class="font-fredoka font-semibold">Total</p>
            <p class="font-bubble text-xl text-[#BC5A45]">Rp 125.000</p>
          </div>
          <div>
            <p class="font-fredoka font-semibold">Metode Bayar</p>
            <p class="font-fredoka">QRIS (OVO)</p>
          </div>
          <div>
            <p class="font-fredoka font-semibold">Pengiriman</p>
            <p class="font-fredoka">Ambil Sendiri</p>
          </div>
        </div>

        <div class="border-t border-gray-200 pt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
          <div class="flex gap-2">
            <a href="{{ route('order.detail', 1) }}" class="bg-[#6B8E23] text-white px-4 py-2 rounded-full font-bubble text-sm hover:bg-[#5a7520] transition">
              <i class="fas fa-eye mr-1"></i> Detail
            </a>
            <button class="bg-green-500 text-white px-4 py-2 rounded-full font-bubble text-sm hover:bg-green-600 transition">
              <i class="fab fa-whatsapp mr-1"></i> Konfirmasi
            </button>
          </div>
          <p class="text-sm font-fredoka text-red-500">
            <i class="fas fa-clock mr-1"></i> Batas: 15 Februari 2026 • 02:30
          </p>
        </div>
      </div>

      <!-- Order Item 2 (Completed) -->
      <div class="bg-white rounded-3xl shadow-lg p-6 border-2 border-gray-300 hover:shadow-xl transition">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
          <div>
            <span class="font-bubble text-2xl text-[#BC5A45]">INV/PB/20260213/0042</span>
            <p class="font-fredoka text-sm text-gray-500">13 Februari 2026 • 10:15</p>
          </div>
          <span class="status-badge status-completed">Selesai</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <p class="font-fredoka font-semibold">Total</p>
            <p class="font-bubble text-xl text-[#BC5A45]">Rp 85.000</p>
          </div>
          <div>
            <p class="font-fredoka font-semibold">Metode Bayar</p>
            <p class="font-fredoka">Transfer BCA</p>
          </div>
          <div>
            <p class="font-fredoka font-semibold">Pengiriman</p>
            <p class="font-fredoka">GoSend</p>
          </div>
        </div>

        <div class="border-t border-gray-200 pt-4">
          <a href="{{ route('order.detail', 2) }}" class="bg-[#6B8E23] text-white px-4 py-2 rounded-full font-bubble text-sm hover:bg-[#5a7520] transition inline-block">
            <i class="fas fa-eye mr-1"></i> Detail
          </a>
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
      <a href="{{ route('order.my-orders') }}" class="footer-link active">cek pesanan</a>
    </div>

    <div class="footer-right">
      <a href="{{ route('home') }}" class="footer-logo-link">
        <img src="{{ asset('assets/images/logobrand.png') }}" alt="PempekBunda 75 Logo" class="footer-logo">
      </a>
    </div>
  </footer>

  <style>
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
    
    .nav-link:hover::after,
    .nav-link.active::after {
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
    
    .footer-link:hover,
    .footer-link.active {
      color: #ffd9cc;
    }
    
    .footer-logo {
      width: 150px;
    }

    @media (max-width: 768px) {
      .header { flex-direction: row; padding: 12px 20px; }
      .footer { flex-direction: row !important; justify-content: space-between; align-items: center; padding: 24px 20px; text-align: left; }
      .footer-left { align-items: flex-start; gap: 8px; }
      .footer-right { margin-left: 0; justify-content: flex-end; }
      .footer-logo { width: 80px; }
      .footer-link { font-size: 14px; }
    }
  </style>

</body>
</html>
