<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order - Pempek Bunda 75</title>

  <!-- RASCAL FONT -->
  <style>
    @font-face {
      font-family: 'RASCAL';
      src: url('<?php echo e(asset("fonts/RASCAL__.TTF")); ?>') format('truetype');
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
  
  <!-- Alpine.js CDN -->
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
    
    /* ===== ANIMASI ===== */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInLeft {
      from {
        opacity: 0;
        transform: translateX(-40px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(40px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .animate-fade-up {
      animation: fadeInUp 0.8s ease forwards;
    }

    .animate-fade-left {
      animation: fadeInLeft 0.8s ease forwards;
    }

    .animate-fade-right {
      animation: fadeInRight 0.8s ease forwards;
    }

    .animate-scale {
      animation: scaleIn 0.6s ease forwards;
    }

    .delay-1 { animation-delay: 0.2s; }
    .delay-2 { animation-delay: 0.4s; }
    .delay-3 { animation-delay: 0.6s; }
    .delay-4 { animation-delay: 0.8s; }

    /* ===== FLOATING CART BUTTON ===== */
    .floating-cart-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      z-index: 9999;
      background-color: #6B8E23;
      color: white;
      border-radius: 60px;
      padding: 15px 25px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      transition: all 0.3s ease;
      border: 3px solid #BC5A45;
      display: flex;
      align-items: center;
      gap: 15px;
      animation: float 3s ease-in-out infinite;
    }

    .floating-cart-btn:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
      background-color: #5a7520;
    }

    .cart-icon-wrapper {
      position: relative;
    }

    .cart-icon-wrapper i {
      font-size: 28px;
    }

    .cart-count-badge {
      position: absolute;
      top: -10px;
      right: -10px;
      background-color: #BC5A45;
      color: white;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: bold;
      border: 2px solid white;
      font-family: 'Fredoka', sans-serif;
    }

    .cart-info {
      display: flex;
      flex-direction: column;
      text-align: left;
    }

    .cart-info .cart-title {
      font-size: 16px;
      opacity: 0.9;
      font-family: 'Fredoka', sans-serif;
    }

    .cart-info .cart-total {
      font-size: 20px;
      font-weight: bold;
      font-family: 'Bubblegum Sans', cursive;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    /* ===== CART DRAWER ===== */
    .cart-drawer {
      position: fixed;
      bottom: 130px;
      right: 30px;
      width: 380px;
      max-width: 90vw;
      background-color: #FFF9F0;
      border-radius: 25px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      z-index: 9998;
      transform: scale(0);
      opacity: 0;
      transition: all 0.3s ease;
      border: 4px solid #6B8E23;
      overflow: hidden;
      transform-origin: bottom right;
    }

    .cart-drawer.active {
      transform: scale(1);
      opacity: 1;
    }

    .cart-drawer-header {
      background-color: #6B8E23;
      color: white;
      padding: 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 3px solid #BC5A45;
    }

    .cart-drawer-header h3 {
      font-size: 24px;
      font-family: 'Bubblegum Sans', cursive;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .cart-drawer-header button {
      background: none;
      border: none;
      color: white;
      font-size: 20px;
      cursor: pointer;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.2);
      transition: all 0.2s ease;
    }

    .cart-drawer-header button:hover {
      background-color: rgba(255, 255, 255, 0.3);
      transform: rotate(90deg);
    }

    .cart-drawer-items {
      max-height: 350px;
      overflow-y: auto;
      padding: 15px;
    }

    .cart-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 0;
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .cart-item:last-child {
      border-bottom: none;
    }

    .cart-item-info {
      flex: 1;
    }

    .cart-item-name {
      font-size: 18px;
      font-weight: bold;
      color: #4a3728;
      margin-bottom: 5px;
      font-family: 'Fredoka', sans-serif;
    }

    .cart-item-price {
      font-size: 16px;
      color: #BC5A45;
      font-weight: bold;
      font-family: 'Fredoka', sans-serif;
    }

    .cart-item-quantity {
      display: flex;
      align-items: center;
      gap: 12px;
      background-color: #f5e8d0;
      padding: 5px 10px;
      border-radius: 30px;
    }

    .cart-item-quantity span {
      font-size: 18px;
      font-weight: bold;
      min-width: 25px;
      text-align: center;
      font-family: 'Fredoka', sans-serif;
    }

    .cart-item-quantity button {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background-color: #BC5A45;
      color: white;
      border: none;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }

    .cart-item-quantity button:hover {
      background-color: #a34d3b;
      transform: scale(1.1);
    }

    .cart-item-quantity button:disabled {
      background-color: #ccc;
      cursor: not-allowed;
      transform: none;
    }

    .cart-drawer-footer {
      background-color: #f5e8d0;
      padding: 20px;
      border-top: 2px solid #6B8E23;
    }

    .cart-grand-total {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 22px;
      font-weight: bold;
      color: #4a3728;
      margin-bottom: 15px;
      font-family: 'Fredoka', sans-serif;
    }

    .cart-grand-total span:last-child {
      color: #BC5A45;
      font-size: 26px;
    }

    .cart-payment-btn {
      display: block;
      width: 100%;
      background-color: #BC5A45;
      color: white;
      text-align: center;
      padding: 15px;
      border-radius: 50px;
      font-size: 20px;
      font-weight: bold;
      text-decoration: none;
      transition: all 0.2s ease;
      border: none;
      cursor: pointer;
      font-family: 'Bubblegum Sans', cursive;
      letter-spacing: 1px;
      box-shadow: 0 5px 15px rgba(188, 90, 69, 0.3);
    }

    .cart-payment-btn:hover {
      background-color: #a34d3b;
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(188, 90, 69, 0.4);
    }

    .cart-payment-btn i {
      margin-right: 10px;
    }

    .empty-cart {
      text-align: center;
      padding: 40px 20px;
      font-size: 18px;
      color: #999;
      font-family: 'Fredoka', sans-serif;
    }

    .empty-cart i {
      font-size: 50px;
      margin-bottom: 15px;
      opacity: 0.3;
    }
    
    /* ===== MODAL STYLES (BLOG) ===== */
    .modal-fixed {
      position: fixed;
      inset: 0;
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      background-color: rgba(74, 55, 40, 0.6);
      backdrop-filter: blur(8px);
    }
    
    .modal-container {
      background-color: #FFF9F0;
      width: 95%;
      max-width: 80rem;
      max-height: 70vh;
      border-radius: 3rem;
      overflow: hidden;
      border: 12px solid #6B8E23;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      position: relative;
      margin: 0;
      transform: translateY(7px);
    }
    
    .modal-content {
      display: flex;
      flex-direction: column;
      max-height: 70vh;
      overflow: hidden;
    }
    
    @media (min-width: 768px) {
      .modal-content {
        flex-direction: row;
      }
    }
    
    .modal-image {
      width: 100%;
      padding: 1.5rem;
    }
    
    @media (min-width: 768px) {
      .modal-image {
        width: 40%;
      }
    }
    
    .modal-image-inner {
      position: sticky;
      top: 0;
      border-radius: 2rem;
      overflow: hidden;
      border: 4px solid #BC5A45;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
      transform: rotate(2deg);
    }
    
    .modal-image-inner img {
      width: 100%;
      height: 16rem;
      object-fit: cover;
    }
    
    @media (min-width: 768px) {
      .modal-image-inner img {
        height: 400px;
      }
    }
    
    .modal-details {
      width: 100%;
      padding: 1.8rem;
      background-color: rgba(255, 255, 255, 0.5);
      overflow-y: hidden;
      display: flex;
      flex-direction: column;
    }
    
    @media (min-width: 768px) {
      .modal-details {
        width: 60%;
        padding: 2.2rem;
        overflow-y: hidden;
      }
    }

    .modal-details .content-wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .modal-details .main-content {
      flex: 1;
    }

    .modal-details .price-action {
      margin-top: auto;
      padding-top: 1.5rem;
      border-top: 2px solid rgba(188, 90, 69, 0.1);
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
    }

    .modal-details .price-action .price-info {
      text-align: left;
    }

    .modal-details .price-action .price-info p:first-child {
      font-size: 1.6rem !important;
      opacity: 0.6;
      margin-bottom: 0.2rem;
    }

    .modal-details .price-action .price-info p:last-child {
      font-size: 3.5rem !important;
      color: #BC5A45;
      font-weight: bold;
      line-height: 1;
    }

    .modal-details .price-action button {
      background-color: #6B8E23;
      color: white;
      padding: 1.2rem 2.2rem;
      border-radius: 2rem;
      font-size: 2rem;
      font-weight: bold;
      transition: all 0.2s ease;
      box-shadow: 0 8px 0 0 #4a6318;
      white-space: nowrap;
      border: none;
      cursor: pointer;
    }

    .modal-details .price-action button:hover {
      transform: scale(1.05);
    }

    .modal-details .price-action button:active {
      transform: scale(0.95);
    }

    .modal-details h2 {
      font-size: 3.2rem !important;
      line-height: 1.1;
      margin-bottom: 1.8rem;
    }

    .modal-details h4 {
      font-size: 2.3rem !important;
      margin-bottom: 1rem;
    }

    .modal-details p.text-2xl {
      font-size: 1.6rem !important;
      line-height: 1.4;
    }

    .modal-details p.text-3xl.font-bold {
      font-size: 2.5rem !important;
    }

    .modal-details .text-2xl.uppercase {
      font-size: 1.6rem !important;
      letter-spacing: 0.2em;
    }

    .modal-details .text-4xl {
      font-size: 2.8rem !important;
    }
    
    .quantity-selector {
      display: flex;
      align-items: center;
      gap: 1.3rem;
      margin-top: 1.3rem;
    }
    
    .quantity-btn {
      width: 3.8rem;
      height: 3.8rem;
      border-radius: 9999px;
      background-color: #BC5A45;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.1rem;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.2s ease;
      border: none;
    }
    
    .quantity-btn:hover {
      background-color: #a34d3b;
      transform: scale(1.1);
    }
    
    .quantity-btn:active {
      transform: scale(0.95);
    }
    
    .quantity-value {
      font-size: 2.3rem;
      font-weight: bold;
      min-width: 3.2rem;
      text-align: center;
    }
    
    /* ===== PRODUCT CARD STYLES ===== */
    .product-card {
      transition: all 0.3s ease;
      border-radius: 3rem;
    }

    .product-card:hover {
      transform: translateY(-10px) scale(1.02);
    }

    .product-card h3 {
      font-size: 3.5rem !important;
      line-height: 1.2;
      margin-bottom: 0.8rem;
    }

    .product-card p.text-xl {
      font-size: 2.5rem !important;
      font-weight: 700;
    }

    .product-card .absolute.top-4.right-4 {
      font-size: 1.8rem !important;
      padding: 0.8rem 1.5rem !important;
    }

    .product-card button.w-full {
      font-size: 2.2rem !important;
      padding: 1.5rem 2rem !important;
      border-radius: 2rem;
      border: none;
      cursor: pointer;
    }

    .product-card p.text-xs {
      font-size: 1.8rem !important;
      margin-top: 1.5rem !important;
      font-style: italic;
      opacity: 0.8;
    }

    .hero-section .inline-block {
      font-size: 1.8rem !important;
      padding: 0.6rem 1.2rem !important;
    }

    .hero-section h1 {
      font-weight: 700 !important;
    }

    .hero-section p.text-2xl {
      font-size: 2.5rem !important;
      line-height: 1.5;
    }

    .products-section h2 {
      font-weight: 700 !important;
    }

    .full-height-section {
      min-height: calc(100vh - 120px);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 0;
    }

    .hero-section {
      min-height: calc(100vh - 120px);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .products-section {
      min-height: calc(100vh - 120px);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 4rem 0;
    }

    .cta-section {
      min-height: calc(100vh - 120px);
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
<body x-data="cartSystem()" x-init="initCart()" class="min-h-screen flex flex-col">

  <!-- HEADER -->
  <header class="header">
    <div class="logo-container">
      <a href="<?php echo e(route('home')); ?>" class="logo-link">
        <img src="<?php echo e(asset('assets/images/logobrand.png')); ?>" alt="Pempek Bunda 75 Logo" class="brand-logo">
      </a>
    </div>

    <div class="header-right">
      <nav class="nav">
        <a href="<?php echo e(route('home')); ?>" class="nav-link">home</a>
        <a href="#products" class="nav-link">produk</a>
        <a href="<?php echo e(route('order.cart')); ?>" class="nav-link">cek pesanan</a>
      </nav>
      <a href="#" id="order-top-btn" class="btn-header">order</a>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <main class="flex-grow" style="margin-top: 120px;">

    <!-- HERO SECTION -->
    <section id="top" class="hero-section px-6 md:px-12 max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row items-center justify-between gap-12 w-full">
        <div class="md:w-1/2 space-y-6 animate-fade-left">
          <div class="inline-block bg-[#6B8E23] text-white font-fredoka px-4 py-1 rounded-full text-sm font-bold tracking-widest uppercase rotate-[-2deg] mb-2">
            Order Page
          </div>
          <h1 class="text-8xl md:text-9xl lg:text-9xl font-rascal leading-[0.8] mb-4 font-bold" style="color: #7c2d12; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
            Pilih <br />
            <span class="ml-12">Menu Anda</span>
          </h1>
          <p class="text-2xl md:text-3xl font-fredoka text-[#4a3728]/80 max-w-md leading-relaxed animate-fade-up delay-1">
            Klik pada produk untuk membaca <span class="text-[#BC5A45] font-bold">deskripsi</span> menarik, lalu tambahkan ke keranjang!
          </p>
        </div>
        
        <div class="md:w-1/2 relative group animate-fade-right">
          <div class="relative z-10 rounded-[5rem] border-[15px] border-[#6B8E23] overflow-hidden shadow-[30px_30px_0px_0px_rgba(188,90,69,0.1)] aspect-square -rotate-3 transition-transform duration-500 group-hover:rotate-0">
            <img 
              src="<?php echo e(asset('assets/images/pempekorder.jpg')); ?>" 
              alt="Pempek Bunda 75" 
              class="w-full h-full object-cover"
            />
          </div>
          <div class="absolute -top-10 -right-10 text-6xl text-[#BC5A45] animate-bounce select-none">★</div>
          <div class="absolute -bottom-10 -left-10 text-6xl text-[#6B8E23] animate-pulse select-none">★</div>
          <div class="absolute top-1/2 -right-20 text-4xl text-[#BC5A45]/30 select-none hidden lg:block">★ ★ ★</div>
        </div>
      </div>
    </section>

    <!-- STARS DIVIDER -->
    <div class="flex justify-center space-x-4 py-8 overflow-hidden select-none">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < 12; $i++): ?>
        <span class="text-[#BC5A45] text-4xl md:text-5xl">★</span>
      <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- PRODUCTS GRID SECTION -->
    <section id="products" class="products-section px-6 md:px-12 max-w-7xl mx-auto relative scroll-mt-32">
      <div class="absolute top-0 left-0 w-64 h-64 bg-[#BC5A45]/5 rounded-full blur-3xl -z-10"></div>
      <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#6B8E23]/5 rounded-full blur-3xl -z-10"></div>

      <div class="w-full">
        <div class="flex flex-col items-center mb-12">
          <h2 class="text-6xl md:text-8xl font-rascal text-center mb-4 animate-fade-up font-bold" style="color: #7c2d12;">Daftar Menu</h2>
          <div class="w-24 h-2 bg-[#BC5A45] rounded-full animate-scale"></div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($products) && $products->isEmpty()): ?>
          <div class="text-center py-20">
            <p class="text-2xl font-fredoka text-gray-500">Belum ada produk tersedia.</p>
          </div>
        <?php elseif(isset($products)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-16 gap-y-24">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="product-card group cursor-pointer flex flex-col items-center" @click="showProductModal(<?php echo e($product['id']); ?>)">
            <div class="relative mb-6 w-full aspect-square overflow-hidden rounded-[3rem] border-[10px] border-[#6B8E23] p-1 bg-white shadow-[15px_15px_0px_0px_rgba(188,90,69,0.2)] group-hover:shadow-[20px_20px_0px_0px_rgba(188,90,69,0.3)] transition-all duration-300 transform group-hover:-rotate-2">
              <img 
                src="<?php echo e($product['image']); ?>" 
                alt="<?php echo e($product['name']); ?>" 
                class="w-full h-full object-cover rounded-[2.2rem] group-hover:scale-105 transition-transform duration-700"
              />
              <div class="absolute top-4 right-4 bg-[#BC5A45] text-white font-bubble px-4 py-1 rounded-full text-sm rotate-12 shadow-md">
                Stok: <?php echo e($product['stok']); ?>

              </div>
            </div>
            
            <h3 class="text-3xl font-bubble text-[#BC5A45] text-center mb-1 group-hover:scale-110 transition-transform">
              <?php echo e($product['name']); ?>

            </h3>
            <p class="text-xl font-fredoka font-semibold text-[#6B8E23] mb-4">
              Rp <?php echo e(number_format($product['price'], 0, ',', '.')); ?>

            </p>
            
            <div class="flex flex-col w-full space-y-2">
              <button 
                @click.stop="addToCart(<?php echo e($product['id']); ?>, '<?php echo e($product['name']); ?>', <?php echo e($product['price']); ?>, '<?php echo e($product['image']); ?>')"
                class="w-full bg-[#BC5A45] text-white font-bubble text-xl py-3 rounded-2xl hover:bg-[#a34d3b] shadow-lg transform active:scale-95 transition-all"
              >
                + Tambah ke keranjang
              </button>
              <p class="w-full text-center text-xs font-fredoka text-[#4a3728]/60 italic" style="margin-top: 1.5rem;">
                Klik gambar produk untuk baca deskripsi
              </p>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-20">
          <p class="text-2xl font-fredoka text-gray-500">Error memuat produk.</p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
    </section>

    <!-- STARS DIVIDER -->
    <div class="flex justify-center space-x-4 py-8 overflow-hidden select-none">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < 12; $i++): ?>
        <span class="text-[#BC5A45] text-4xl md:text-5xl">★</span>
      <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- FLOATING CALL TO ACTION -->
    <section class="cta-section px-6 md:px-12 max-w-5xl mx-auto">
      <div class="w-full">
        <div class="bg-[#6B8E23] rounded-[4rem] p-16 md:p-24 shadow-2xl relative overflow-hidden animate-scale text-center">
          <div class="absolute inset-0 opacity-10 pointer-events-none flex flex-wrap gap-6 p-6 justify-center">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < 25; $i++): ?>
              <span class="text-white text-3xl md:text-4xl">★</span>
            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>

          <h2 class="text-6xl md:text-8xl font-bubble text-white mb-8 leading-tight relative z-10 animate-fade-up">
            Bingung Pilih <br /> yang Mana?
          </h2>
          <p class="text-2xl md:text-3xl font-fredoka text-white/90 mb-12 max-w-2xl mx-auto relative z-10 animate-fade-up delay-1 leading-relaxed">
            Tenang Bunda, semua pempek kami dibuat dengan ikan tenggiri murni. Semua produk segar dan berkualitas!
          </p>
          <!-- 🔥 TOMBOL LIhat Keranjang - SEKARANG CEK LOGIN DULU -->
          <a 
            href="#" 
            id="lihatKeranjangBtn"
            class="inline-block bg-[#FFF9F0] text-[#BC5A45] font-bubble text-3xl md:text-4xl px-16 py-6 rounded-[3rem] hover:scale-110 active:scale-95 transition-all shadow-xl relative z-10 animate-scale delay-2"
          >
            Lihat Keranjang 🛒
          </a>
        </div>
      </div>
    </section>

  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-left">
      <a href="#" id="footer-order-btn" class="footer-link">order</a>
      <a href="<?php echo e(route('home')); ?>" class="footer-link">home</a>
      <a href="#products" class="footer-link">produk</a>
      <a href="<?php echo e(route('order.cart')); ?>" class="footer-link">cek pesanan</a>
    </div>

    <div class="footer-right">
      <a href="<?php echo e(route('home')); ?>" class="footer-logo-link">
        <img src="<?php echo e(asset('assets/images/logobrand.png')); ?>" alt="Pempek Bunda 75 Logo" class="footer-logo">
      </a>
    </div>
  </footer>

  <!-- FLOATING CART BUTTON - MUNCUL SAAT ADA ITEM -->
  <template x-if="cartCount > 0">
    <div>
      <!-- Floating Cart Button -->
      <div class="floating-cart-btn" @click="toggleCartDrawer">
        <div class="cart-icon-wrapper">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-count-badge" x-text="cartCount"></span>
        </div>
        <div class="cart-info">
          <span class="cart-title">Keranjangmu</span>
          <span class="cart-total" x-text="'Rp ' + cartTotal.toLocaleString('id-ID')"></span>
        </div>
      </div>

      <!-- Cart Drawer -->
      <div class="cart-drawer" :class="{ 'active': cartDrawerOpen }">
        <div class="cart-drawer-header">
          <h3>
            <i class="fas fa-shopping-cart"></i> 
            Detail Keranjang
          </h3>
          <button @click="cartDrawerOpen = false">
            <i class="fas fa-times"></i>
          </button>
        </div>
        
        <!-- Cart Drawer Items -->
        <div class="cart-drawer-items">
          <template x-for="(item, index) in cart" :key="item.id">
            <div class="cart-item">
              <div class="cart-item-info">
                <div class="cart-item-name" x-text="item.name"></div>
                <div class="cart-item-price" x-text="'Rp ' + (item.price * item.quantity).toLocaleString('id-ID')"></div>
              </div>
              <div class="flex items-center gap-3">
                <div class="cart-item-quantity">
                  <button @click="updateCartQuantity(index, item.quantity - 1)" :disabled="item.quantity <= 0">
                    <i class="fas fa-minus"></i>
                  </button>
                  <span x-text="item.quantity"></span>
                  <button @click="updateCartQuantity(index, item.quantity + 1)">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- Tombol Hapus -->
                <button @click="removeItem(index)" class="text-red-500 hover:text-red-700 ml-2" title="Hapus item">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </div>
          </template>
          
          <div class="empty-cart" x-show="cart.length === 0" x-cloak>
            <i class="fas fa-shopping-cart"></i>
            <p>Keranjang kosong</p>
          </div>
        </div>
        
        <div class="cart-drawer-footer">
          <div class="cart-grand-total">
            <span>Total Pembayaran</span>
            <span x-text="'Rp ' + cartTotal.toLocaleString('id-ID')"></span>
          </div>
          <!-- 🔥 TOMBOL LANGSUNG BAYAR - CEK LOGIN DULU -->
          <a href="#" @click.prevent="checkout" class="cart-payment-btn">
            <i class="fas fa-credit-card"></i> LANGSUNG BAYAR
          </a>
        </div>
      </div>
    </div>
  </template>

  <!-- PRODUCT MODAL (BLOG) -->
  <div id="productModal" class="modal-fixed" x-show="modalOpen" x-cloak @click.away="closeModal">
    <div class="modal-container">
      <div class="modal-content">
        <div class="absolute top-6 left-6 text-[#BC5A45] text-3xl opacity-50 select-none z-10">★ ★ ★</div>
        
        <button 
          @click="closeModal"
          class="absolute top-6 right-6 z-20 w-14 h-14 flex items-center justify-center bg-[#BC5A45] text-white rounded-full hover:rotate-90 transition-transform shadow-lg text-3xl"
        >
          <i class="fas fa-times"></i>
        </button>

        <div class="modal-image">
          <div class="modal-image-inner">
            <img x-bind:src="selectedProduct.image" alt="Product Image" />
          </div>
        </div>
        
        <div class="modal-details">
          <div class="content-wrapper">
            <div class="main-content">
              <h2 class="font-bubble text-[#BC5A45] mb-8 leading-tight font-rascal" x-text="selectedProduct.name"></h2>
              
              <div class="space-y-8 font-fredoka text-[#4a3728] leading-relaxed">
                <section>
                  <h4 class="text-3xl font-bubble text-[#6B8E23] mb-4 flex items-center">
                    <span class="mr-3 text-4xl">✨</span> <span x-text="'Tentang ' + selectedProduct.name"></span>
                  </h4>
                  <p class="text-2xl" x-text="selectedProduct.description"></p>
                </section>

                <section class="mt-6">
                  <h4 class="text-3xl font-bubble text-[#6B8E23] mb-4 flex items-center">
                    <span class="mr-3 text-4xl">📦</span> Stok Tersedia
                  </h4>
                  <p class="text-3xl font-bold" x-text="selectedProduct.stok + ' pcs'"></p>
                </section>

                <div class="mt-6">
                  <h4 class="text-3xl font-bubble text-[#6B8E23] mb-4 flex items-center">
                    <span class="mr-3 text-4xl">🔢</span> Jumlah
                  </h4>
                  <div class="quantity-selector">
                    <button class="quantity-btn" @click="if(quantity > 1) quantity--" :disabled="quantity <= 1">
                      <i class="fas fa-minus"></i>
                    </button>
                    <span class="quantity-value" x-text="quantity"></span>
                    <button class="quantity-btn" @click="if(quantity < selectedProduct.stok) quantity++" :disabled="quantity >= selectedProduct.stok">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <p class="text-xl mt-2 opacity-60" x-show="quantity >= selectedProduct.stok">Stok maksimal <span x-text="selectedProduct.stok"></span></p>
                </div>
              </div>
            </div>

            <!-- HARGA DAN TOMBOL DI BAWAH -->
            <div class="price-action">
              <div class="price-info">
                <p>Harga Per Paket</p>
                <p x-text="'Rp ' + selectedProduct.price.toLocaleString('id-ID')"></p>
              </div>
              <button @click="addToCartFromModal">
                <i class="fas fa-cart-plus mr-2"></i> Tambah
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CART SYSTEM SCRIPT (LANGSUNG DI BLADE) -->
  <script>
    function cartSystem() {
      return {
        cart: [],
        cartCount: 0,
        cartTotal: 0,
        cartDrawerOpen: false,
        modalOpen: false,
        selectedProduct: {},
        quantity: 1,
        
        initCart() {
          try {
            const saved = localStorage.getItem('cart');
            this.cart = saved ? JSON.parse(saved) : [];
            this.updateCartSummary();
            console.log('Cart loaded:', this.cart);
            
            // 🔥 CEK STATUS LOGIN DARI SERVER
            fetch('/api/check-auth')
              .then(res => res.json())
              .then(data => {
                window.isLoggedIn = data.authenticated;
              })
              .catch(() => {
                window.isLoggedIn = false;
              });
          } catch (e) {
            console.error('Cart error:', e);
            this.cart = [];
            this.updateCartSummary();
          }
        },
        
        updateCartSummary() {
          this.cartCount = this.cart?.reduce((sum, item) => sum + (item?.quantity || 0), 0) || 0;
          this.cartTotal = this.cart?.reduce((sum, item) => sum + ((item?.price || 0) * (item?.quantity || 0)), 0) || 0;
          localStorage.setItem('cart', JSON.stringify(this.cart || []));
        },
        
        toggleCartDrawer() {
          this.cartDrawerOpen = !this.cartDrawerOpen;
        },
        
        updateCartQuantity(index, newQuantity) {
          if (newQuantity < 1) {
            // Hapus item jika quantity 0
            this.cart.splice(index, 1);
            this.showNotification('Item dihapus dari keranjang');
          } else {
            this.cart[index].quantity = newQuantity;
          }
          this.updateCartSummary();
        },
        
        removeItem(index) {
          const itemName = this.cart[index].name;
          this.cart.splice(index, 1);
          this.showNotification(`🗑️ ${itemName} dihapus dari keranjang`);
          this.updateCartSummary();
        },
        
        addToCart(id, name, price, image) {
          if (!id || !price) {
            console.error('Invalid product');
            return;
          }
          
          const existing = this.cart?.find(item => item.id === id);
          
          if (existing) {
            existing.quantity = (existing.quantity || 0) + 1;
          } else {
            this.cart.push({
              id, name, price, image,
              quantity: 1
            });
          }
          
          this.updateCartSummary();
          this.showNotification(name + ' ditambahkan ke keranjang!');
          this.cartDrawerOpen = true;
        },
        
        addToCartFromModal() {
          if (!this.selectedProduct || !this.selectedProduct.id) {
            console.error('No product selected');
            return;
          }
          
          const existing = this.cart?.find(item => item.id === this.selectedProduct.id);
          
          if (existing) {
            existing.quantity += this.quantity;
          } else {
            this.cart.push({
              id: this.selectedProduct.id,
              name: this.selectedProduct.name,
              price: this.selectedProduct.price,
              image: this.selectedProduct.image,
              quantity: this.quantity
            });
          }
          
          this.updateCartSummary();
          this.closeModal();
          this.showNotification(this.selectedProduct.name + ' (' + this.quantity + ' item) ditambahkan!');
          this.cartDrawerOpen = true;
        },
        
        showProductModal(productId) {
          // Cari produk dari data yang dikirim server
          const products = <?php echo json_encode($products ?? [], 15, 512) ?>;
          const product = products.find(p => p.id === productId);
          
          if (product) {
            this.selectedProduct = product;
            this.quantity = 1;
            this.modalOpen = true;
          } else {
            console.error('Product not found:', productId);
          }
        },
        
        closeModal() {
          this.modalOpen = false;
          this.quantity = 1;
        },
        
        showNotification(message) {
          if (!message) return;
          
          const notif = document.createElement('div');
          notif.className = 'fixed top-4 right-4 bg-[#6B8E23] text-white px-6 py-3 rounded-full font-fredoka z-[100000] shadow-lg animate-bounce';
          notif.innerHTML = '<i class="fas fa-check-circle mr-2"></i> ' + message;
          document.body.appendChild(notif);
          
          setTimeout(() => notif.remove(), 2000);
        },
        
        // 🔥 FUNGSI CHECKOUT - CEK LOGIN DULU
        checkout() {
          if (window.isLoggedIn) {
            // Jika sudah login, lanjut ke payment
            window.location.href = '<?php echo e(route("order.payment")); ?>';
          } else {
            // Jika belum login, redirect ke login dengan parameter return
            window.location.href = '<?php echo e(route("login")); ?>?redirect=' + encodeURIComponent('<?php echo e(route("order.payment")); ?>');
          }
        }
      }
    }
  </script>

  <!-- 🔥 HANDLER UNTUK TOMBOL LIHAT KERANJANG -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const lihatKeranjangBtn = document.getElementById('lihatKeranjangBtn');
      if (lihatKeranjangBtn) {
        lihatKeranjangBtn.addEventListener('click', function(e) {
          e.preventDefault();
          
          // Cek apakah user sudah login
          fetch('/api/check-auth')
            .then(res => res.json())
            .then(data => {
              if (data.authenticated) {
                window.location.href = '<?php echo e(route("order.cart")); ?>';
              } else {
                window.location.href = '<?php echo e(route("login")); ?>?redirect=' + encodeURIComponent('<?php echo e(route("order.cart")); ?>');
              }
            })
            .catch(() => {
              window.location.href = '<?php echo e(route("login")); ?>?redirect=' + encodeURIComponent('<?php echo e(route("order.cart")); ?>');
            });
        });
      }

      // Smooth scroll links
      const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
      
      smoothScrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          const href = this.getAttribute('href');
          
          if (href !== '#') {
            e.preventDefault();
            
            const targetId = href;
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
              const headerHeight = document.querySelector('.header')?.offsetHeight || 0;
              const targetPosition = targetElement.offsetTop - headerHeight - 20;
              
              window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
              });
              
              document.querySelectorAll('.nav-link').forEach(navLink => {
                navLink.classList.remove('active');
              });
              this.classList.add('active');
            }
          }
        });
      });
      
      function scrollToTop(e) {
        e.preventDefault();
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      }
      
      const orderTopBtn = document.getElementById('order-top-btn');
      if (orderTopBtn) {
        orderTopBtn.addEventListener('click', scrollToTop);
      }
      
      const footerOrderBtn = document.getElementById('footer-order-btn');
      if (footerOrderBtn) {
        footerOrderBtn.addEventListener('click', scrollToTop);
      }
      
      function updateActiveNavOnScroll() {
        const sections = document.querySelectorAll('section[id]');
        const scrollPosition = window.scrollY + (document.querySelector('.header')?.offsetHeight || 0) + 50;
        
        sections.forEach(section => {
          const sectionTop = section.offsetTop;
          const sectionHeight = section.offsetHeight;
          const sectionId = section.getAttribute('id');
          
          if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            document.querySelectorAll('.nav-link').forEach(link => {
              link.classList.remove('active');
              if (link.getAttribute('href') === `#${sectionId}`) {
                link.classList.add('active');
              }
            });
          }
        });
      }
      
      window.addEventListener('scroll', updateActiveNavOnScroll);
      
      const currentHash = window.location.hash || '#home';
      document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === currentHash) {
          link.classList.add('active');
        }
      });
    });
  </script>

  <style>
    [x-cloak] { display: none !important; }
    
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
    }

    .btn-header:hover {
      background: #b55242;
      border-color: #b55242;
      transform: translateY(-2px);
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
      html { scroll-padding-top: 80px; }
      
      .floating-cart-btn {
        bottom: 20px;
        right: 20px;
        padding: 12px 20px;
      }
      
      .cart-drawer {
        bottom: 110px;
        right: 20px;
        width: 350px;
      }
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
      html { scroll-padding-top: 120px; }
      
      .floating-cart-btn {
        bottom: 15px;
        right: 15px;
      }
      
      .cart-drawer {
        bottom: 100px;
        right: 15px;
        width: 320px;
      }
    }

    @media (max-width: 480px) {
      .header-right { flex-direction: column; gap: 15px; }
      .nav { gap: 15px; }
      .nav-link { font-size: 18px; }
      .btn-header { padding: 8px 20px; font-size: 16px; }
      .footer { padding: 30px 20px; gap: 30px; }
      .footer-link { font-size: 20px; }
      .footer-logo { width: 100px; }
      html { scroll-padding-top: 180px; }
      
      .floating-cart-btn {
        padding: 10px 15px;
      }
      
      .cart-info .cart-title {
        font-size: 14px;
      }
      
      .cart-info .cart-total {
        font-size: 16px;
      }
      
      .cart-drawer {
        width: 290px;
      }
    }

    @media (max-width: 768px) {
      .hero-section,
      .products-section,
      .cta-section {
        min-height: auto;
        padding: 4rem 0;
      }
    }

    .cta-section .bg-\[\#6B8E23\] {
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .cta-section h2,
    .cta-section p,
    .cta-section a {
      margin-left: auto;
      margin-right: auto;
    }
  </style>

</body>
</html><?php /**PATH C:\laragon\www\pempekbunda75\resources\views/order/index.blade.php ENDPATH**/ ?>