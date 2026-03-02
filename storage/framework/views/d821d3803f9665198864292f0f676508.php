<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pempek Bunda 75</title>

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

  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Reenie+Beanie&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
  
  <style>
    /* ================= RESET TOTAL ================= */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      width: 100%;
      overflow-x: hidden;
      scroll-behavior: smooth;
    }

    body {
      margin: 0;
      padding: 0;
      background: #ffffff;
      color: #000;
      font-family: 'Reenie Beanie', cursive;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* ================= HEADER STICKY FIX ================= */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 80px;
      background: rgba(255, 255, 255, 0.98);
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

    html {
      scroll-padding-top: 100px;
    }

    .main-content {
      flex: 1 0 auto;
      width: 100%;
    }

    .hero {
      display: flex;
      align-items: center;
      padding: 100px 150px;
      min-height: 85vh;
    }

    @media (max-width: 1024px) {
      .header { padding: 20px 40px; }
      .main-content { margin-top: 100px; }
      .hero { padding: 80px 40px; }
      html { scroll-padding-top: 80px; }
    }

    @media (max-width: 768px) {
      .header {
        flex-direction: column;
        padding: 15px 20px;
      }
      .main-content { margin-top: 140px; }
      .hero {
        flex-direction: column;
        padding: 60px 20px;
      }
      html { scroll-padding-top: 120px; }
    }

    @media (max-width: 480px) {
      .header { padding: 15px 20px; }
      .main-content { margin-top: 200px; }
      .hero { padding: 60px 20px; }
      html { scroll-padding-top: 180px; }
    }

    /* ================= FOOTER ================= */
    .footer {
      background: #b55242;
      color: #fff;
      padding: 60px 120px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      flex-shrink: 0;
      margin-top: auto;
      box-sizing: border-box;
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
    }

    .footer-link:hover {
      color: #ffd9cc;
    }

    .footer-right {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      margin-left: auto;
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
      .footer { padding: 50px 80px; }
    }

    @media (max-width: 768px) {
      .footer {
        flex-direction: column;
        gap: 40px;
        padding: 40px 20px;
        text-align: center;
      }
      .footer-left {
        align-items: center;
        width: 100%;
      }
      .footer-right {
        margin-left: 0;
        justify-content: center;
        width: 100%;
      }
      .footer-logo { width: 120px; }
    }

    @media (max-width: 480px) {
      .footer { padding: 30px 20px; }
      .footer-logo { width: 100px; }
    }

    /* ================= GOOGLE MAPS ================= */
    .location {
      text-align: center;
      width: 100%;
      padding: 0 40px 100px 40px;
    }

    .location h2 {
      font-size: clamp(48px, 6vw, 90px);
      color: #7c2d12;
      margin-bottom: 50px;
    }

    .maps-container {
      width: 100%;
      max-width: 1400px;
      margin: 0 auto;
      position: relative;
      border-radius: 30px;
      border: 8px solid #7a8f3a;
      box-shadow: 0 25px 70px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      aspect-ratio: 16 / 9;
    }

    .maps-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: none;
    }

    @media (max-width: 768px) {
      .location { padding: 0 20px 80px 20px; }
      .maps-container {
        border-width: 6px;
        aspect-ratio: 4 / 3;
      }
    }

    @media (max-width: 480px) {
      .location { padding: 0 15px 60px 15px; }
      .maps-container {
        border-width: 4px;
        aspect-ratio: 1 / 1;
      }
    }

    /* ================= OUR PRODUCT FIX - RASCAL FONT & CENTER ================= */
    .product {
      padding: 40px 0 60px 0;
      width: 100%;
      text-align: center;
    }

    .product .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 40px;
    }

    .product h2 {
      font-family: 'RASCAL', cursive;
      font-size: clamp(3.5rem, 10vw, 6rem);
      color: #7c2d12;
      margin-bottom: 2.5rem;
      line-height: 1;
      letter-spacing: -0.02em;
      text-align: center;
      width: 100%;
    }

    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }
    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .product-scroll-wrapper {
      display: flex;
      overflow-x: auto;
      gap: 1.5rem;
      padding: 0.5rem 2.5rem 1rem 2.5rem;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
      scroll-snap-type: x mandatory;
    }

    .product-scroll-wrapper a,
    .product-scroll-wrapper > div {
      flex: 0 0 280px;
      scroll-snap-align: start;
      text-decoration: none;
    }

    @media (min-width: 768px) {
      .product-scroll-wrapper a,
      .product-scroll-wrapper > div {
        flex: 0 0 320px;
      }
    }

    .product-scroll-wrapper a > div:first-child,
    .product-scroll-wrapper > div > div:first-child {
      background-color: #61703b;
      padding: 0.75rem;
      border-radius: 1rem;
      transition: transform 0.3s ease;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .product-scroll-wrapper a:hover > div:first-child {
      transform: scale(1.02);
    }

    .product-scroll-wrapper img {
      width: 100%;
      aspect-ratio: 1/1;
      object-fit: cover;
      border-radius: 0.75rem;
    }

    .product-scroll-wrapper a > div:last-child,
    .product-scroll-wrapper > div > div:last-child {
      margin-top: 1rem;
      text-align: center;
    }

    @media (min-width: 768px) {
      .product-scroll-wrapper a > div:last-child,
      .product-scroll-wrapper > div > div:last-child {
        text-align: center;
      }
    }

    .product-scroll-wrapper h3 {
      font-size: 1.25rem;
      font-weight: 600;
      color: #4a3728;
      margin-bottom: 0.25rem;
    }

    @media (min-width: 768px) {
      .product-scroll-wrapper h3 {
        font-size: 2.3rem;
      }
    }

    .product-scroll-wrapper p {
      font-size: 2rem;
      color: #c05c48;
      font-weight: 700;
    }

    .group:hover .absolute {
      opacity: 1;
    }

    .absolute.left-4,
    .absolute.right-4 {
      transition: opacity 0.3s ease;
    }

    .absolute.left-4:hover,
    .absolute.right-4:hover {
      background-color: #a54534;
    }

    .md\:hidden.mt-6 {
      display: flex;
      justify-content: center;
      gap: 0.5rem;
      margin-top: 1.5rem;
    }

    .md\:hidden.mt-6 > div:first-child {
      width: 2rem;
      height: 0.25rem;
      background-color: #c05c48;
      border-radius: 9999px;
    }

    .md\:hidden.mt-6 > div:not(:first-child) {
      width: 0.5rem;
      height: 0.25rem;
      background-color: #d1d5db;
      border-radius: 9999px;
    }
  </style>

  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Reenie+Beanie&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
  
  <!-- ANIMASI LUCU (STARS TIDAK DIANIMASI) -->
  <style>
    /* ===== ANIMASI LUCU ===== */
    
    /* Animasi bounce (memantul) */
    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
    }
    
    .animate-bounce-slow {
      animation: bounce 3s ease-in-out infinite;
    }
    
    .animate-bounce-medium {
      animation: bounce 2s ease-in-out infinite;
    }
    
    .animate-bounce-fast {
      animation: bounce 1s ease-in-out infinite;
    }
    
    /* Animasi wobble (goyang) */
    @keyframes wobble {
      0%, 100% { transform: rotate(0deg); }
      25% { transform: rotate(5deg); }
      75% { transform: rotate(-5deg); }
    }
    
    .animate-wobble {
      animation: wobble 2s ease-in-out infinite;
    }
    
    .animate-wobble-slow {
      animation: wobble 3s ease-in-out infinite;
    }
    
    /* Animasi pulse (denyut) */
    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
    
    .animate-pulse-custom {
      animation: pulse 2s ease-in-out infinite;
    }
    
    /* Animasi slide in */
    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-100px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
    
    .animate-slide-left {
      animation: slideInLeft 1s ease forwards;
    }
    
    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(100px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
    
    .animate-slide-right {
      animation: slideInRight 1s ease forwards;
    }
    
    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(100px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .animate-slide-up {
      animation: slideInUp 1s ease forwards;
    }
    
    /* Animasi fade in */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    .animate-fade {
      animation: fadeIn 2s ease forwards;
    }
    
    /* Animasi shake (guncang) */
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
      20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    .animate-shake {
      animation: shake 0.8s ease-in-out;
    }
    
    .animate-shake:hover {
      animation: shake 0.5s ease-in-out;
    }
    
    /* Animasi floating (melayang) */
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      25% { transform: translateY(-8px) rotate(-2deg); }
      75% { transform: translateY(-5px) rotate(2deg); }
    }
    
    .animate-float {
      animation: float 4s ease-in-out infinite;
    }
    
    /* Delay animations */
    .delay-1 { animation-delay: 0.2s; }
    .delay-2 { animation-delay: 0.4s; }
    .delay-3 { animation-delay: 0.6s; }
    .delay-4 { animation-delay: 0.8s; }
    .delay-5 { animation-delay: 1s; }
    
    /* Hover effects */
    .hover-rotate:hover {
      transform: rotate(5deg) scale(1.05);
      transition: all 0.3s ease;
    }
    
    .hover-scale:hover {
      transform: scale(1.1);
      transition: all 0.3s ease;
    }
    
    .hover-bounce:hover {
      animation: bounce 0.5s ease-in-out;
    }
    
    /* Animasi untuk card produk (TETAP SAMA) */
    .product-card {
      transition: all 0.3s ease;
    }
    
    .product-card:hover {
      transform: translateY(-15px) scale(1.05);
    }
    
    /* Animasi untuk tombol */
    .btn-pulse {
      animation: pulse 2s ease-in-out infinite;
    }
    
    .btn-pulse:hover {
      animation: none;
      transform: scale(1.1);
    }

    /* STARS TIDAK DIANIMASI - TETAP SEPERTI ASLINYA */
    .stars {
      display: flex;
      justify-content: center;
      margin: 80px 0;
      opacity: 0.8;
    }

    .stars img {
      width: 80%;
      max-width: 900px;
    }
  </style>
</head>
<body>

<!-- HEADER - FIXED DI ATAS -->
<header class="header">
  <div class="logo-container">
    <a href="#home" class="logo-link">
      <img src="<?php echo e(asset('assets/images/logobrand.png')); ?>" alt="Pempek Bunda 75 Logo" class="brand-logo hover-rotate">
    </a>
  </div>

  <div class="header-right">
    <nav class="nav">
      <a href="#home" class="nav-link active">home</a>
      <a href="#produk" class="nav-link">produk</a>
      <a href="<?php echo e(route('order.my-orders')); ?>" class="nav-link">cek pesanan</a>
    </nav>
    <a href="<?php echo e(route('order.index')); ?>" class="btn-header animate-pulse-custom">order</a>
  </div>
</header>

<!-- MAIN CONTENT -->
<main class="main-content">

  <!-- HERO SECTION -->
  <section class="hero" id="home">
    <div class="hero-left animate-slide-left">
      <h1 class="hero-title font-rascal animate-float">Pempek Bunda 75</h1>
      <a href="<?php echo e(route('order.index')); ?>" class="btn-hero hover-bounce animate-pulse-custom delay-2">order now</a>
    </div>
    <div class="hero-right animate-slide-right">
      <img src="<?php echo e(asset('assets/images/Pempek.png')); ?>" alt="Pempek" class="hero-img animate-float">
    </div>
  </section>

  <!-- STARS - TIDAK DIANIMASI -->
  <div class="stars">
    <img src="<?php echo e(asset('assets/images/Stars.png')); ?>" alt="Stars">
  </div>

  <!-- SEJARAH -->
  <section class="sejarah">
    <div class="sejarah-left animate-slide-left">
      <img src="<?php echo e(asset('assets/images/fotoowner.png')); ?>" alt="Sejarah" class="sejarah-foto hover-rotate animate-float">
    </div>
    <div class="sejarah-right animate-slide-right">
      <h2 class="sejarah-title font-rascal animate-bounce-slow">Sejarah</h2>
      <p class="animate-fade delay-2">
        Pempek Bunda 75 berdiri sejak Juni 2019, terinspirasi dari pengalaman pemilik yang pernah tinggal di Palembang selama kurang lebih 20 tahun. Berawal dari pempek rumahan untuk keluarga, usaha ini berkembang karena banyak yang suka dengan rasa khasnya. Hingga sekarang, Pempek Bunda 75 tetap menjaga kualitas dengan ikan tenggiri murni dan cuko gula batok asli Palembang.
      </p>
    </div>
  </section>

  <!-- STARS - TIDAK DIANIMASI -->
  <div class="stars">
    <img src="<?php echo e(asset('assets/images/Stars.png')); ?>" alt="Stars">
  </div>

  <!-- OUR PRODUCT - HANYA MENAMPILKAN PRODUK DARI DATABASE -->
  <section class="product" id="produk">
    <div class="container">
      <h2 class="font-rascal animate-bounce-slow">Our Product</h2>
    </div>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($featuredProducts) && $featuredProducts->count() > 0): ?>
    <div class="relative group">
      <!-- Navigation Arrows -->
      <button 
        onclick="document.querySelector('.product-scroll-wrapper').scrollBy({ left: -300, behavior: 'smooth' })"
        class="absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-[#c05c48] text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-lg hidden md:block hover-scale"
        aria-label="Scroll left"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      
      <button 
        onclick="document.querySelector('.product-scroll-wrapper').scrollBy({ left: 300, behavior: 'smooth' })"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-[#c05c48] text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-lg hidden md:block hover-scale"
        aria-label="Scroll right"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>

      <!-- Scrollable Container - HANYA PRODUK DARI DATABASE -->
      <div class="product-scroll-wrapper no-scrollbar">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('order.index')); ?>" class="group product-card animate-slide-up" style="animation-delay: <?php echo e(0.1 * $index); ?>s;">
          <div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->gambar && Storage::exists('public/' . $product->gambar)): ?>
              <img src="<?php echo e(asset('storage/' . $product->gambar)); ?>" alt="<?php echo e($product->nama_produk); ?>">
            <?php else: ?>
              <img src="<?php echo e(asset('assets/images/Pempek.png')); ?>" alt="<?php echo e($product->nama_produk); ?>">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
          <div>
            <h3><?php echo e($product->nama_produk); ?></h3>
            <p class="animate-pulse-custom">Rp. <?php echo e(number_format($product->harga, 0, ',', '.')); ?></p>
          </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
    </div>
    
    <!-- Scroll Indicator (Mobile Only) - TETAP SAMA -->
    <div class="md:hidden mt-6">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <?php else: ?>
    <div class="text-center py-12">
      <p class="text-2xl text-gray-600 mb-6 animate-bounce-slow">Belum ada produk tersedia saat ini.</p>
      <a href="<?php echo e(route('produk.index')); ?>" class="inline-block px-8 py-3 bg-[#c05c48] text-white rounded-full text-xl hover:bg-[#a54534] transition-colors hover-scale">
        Lihat Semua Produk
      </a>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </section>

  <!-- STARS - TIDAK DIANIMASI -->
  <div class="stars">
    <img src="<?php echo e(asset('assets/images/Stars.png')); ?>" alt="Stars">
  </div>

  <!-- WHY -->
  <section class="why">
    <h2 class="section-title font-rascal animate-wobble-slow">Why Pempek Bunda 75</h2>
    <div class="why-content animate-fade delay-1">
      <p class="animate-slide-up delay-2">
        Pempek Bunda 75 dibuat untuk menghadirkan pempek dengan rasa yang konsisten dan dapat dipercaya. Setiap produk diolah dengan bahan pilihan dan proses yang terjaga, sehingga pelanggan mendapatkan kualitas yang sama di setiap pesanan. Selain rasa, Pempek Bunda 75 juga mengutamakan keseimbangan antara cita rasa ikan, tekstur pempek, dan karakter cuko. Perpaduan ini menjadi alasan utama mengapa produk dibuat dengan standar yang tidak berubah. Pempek Bunda 75 hadir sebagai pilihan pempek rumahan yang mengedepankan kualitas, kejujuran rasa, dan kepuasan pelanggan.
      </p>
    </div>
  </section>

  <!-- STARS - TIDAK DIANIMASI -->
  <div class="stars">
    <img src="<?php echo e(asset('assets/images/Stars.png')); ?>" alt="Stars">
  </div>

  <!-- LOCATION -->
  <section class="location">
    <h2 class="font-rascal animate-bounce-medium">Location</h2>
    
    <div class="maps-container animate-scale delay-1">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.837538261732!2d109.2415758!3d-7.372099099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655f6f9b6289a3%3A0x5ed7f0db05bd2bf9!2sPEMPEK%20ZAKWAN%20PURWOKERTO!5e0!3m2!1sid!2sid!4v1770862049347!5m2!1sid!2sid" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"
        title="Google Maps - Lokasi Pempek Bunda 75"
        class="hover-scale"
        style="transition: all 0.3s ease;"
      >
      </iframe>
    </div>
    
    <div class="animate-fade delay-2" style="margin-top: 30px; font-size: 28px; color: #7c2d12; font-family: 'Reenie Beanie', cursive;">
      <span class="animate-bounce-fast" style="display: inline-block;">📍</span> J6HR+5J8 Perumahan Saphire Village, Dusun I, Rempoah, Kec. Baturaden, Kabupaten Banyumas, Jawa Tengah
    </div>
  </section>

  <!-- DECORATIVE FLOATING ELEMENTS (TAMBAHAN, TIDAK MENGGANGGU) -->
  <div style="position: fixed; bottom: 20px; left: 20px; z-index: 100; opacity: 0.2; pointer-events: none;">
    <span class="text-4xl text-[#BC5A45] animate-spin-slow">★</span>
  </div>
  <div style="position: fixed; top: 150px; right: 20px; z-index: 100; opacity: 0.2; pointer-events: none;">
    <span class="text-5xl text-[#6B8E23] animate-bounce-slow">★</span>
  </div>

</main>

<!-- FOOTER -->
<footer class="footer">
  <div class="footer-left">
    <a href="<?php echo e(route('order.index')); ?>" class="footer-link hover-bounce">order</a>
    <a href="#home" class="footer-link hover-scale">home</a>
    <a href="#produk" class="footer-link hover-rotate">produk</a>
    <a href="<?php echo e(route('order.my-orders')); ?>" class="footer-link hover-bounce">cek pesanan</a>
  </div>

  <div class="footer-right">
    <a href="#home" class="footer-logo-link">
      <img src="<?php echo e(asset('assets/images/logobrand.png')); ?>" alt="Pempek Bunda 75 Logo" class="footer-logo animate-pulse-custom hover-scale">
    </a>
  </div>
</footer>

<!-- TAMBAHAN ANIMASI UNTUK SEMUA ELEMEN YANG DIHOVER -->
<style>
  /* Efek hover tambahan - TIDAK MENGUBAH STRUKTUR PRODUK */
  .hero-img:hover {
    animation: bounce 0.8s ease-in-out !important;
    cursor: pointer;
  }
  
  .sejarah-foto:hover {
    animation: wobble 0.8s ease-in-out !important;
  }
  
  .footer-link {
    transition: all 0.3s ease;
  }
  
  .footer-link:hover {
    transform: translateX(10px);
    color: #ffd9cc;
  }
  
  /* Animasi untuk tombol order now - TIDAK MENGUBAH PRODUK */
  .btn-hero {
    position: relative;
    overflow: hidden;
  }
  
  .btn-hero::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
  }
  
  .btn-hero:hover::after {
    width: 300px;
    height: 300px;
  }
  
  /* Animasi untuk judul - TIDAK MENGUBAH PRODUK */
  .hero-title {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  .hero-title:hover {
    animation: wobble 0.8s ease-in-out;
    color: #a54534;
  }
</style>

<!-- SCRIPT UNTUK ANIMASI RANDOM (TIDAK MENGGANGGU PRODUK) -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Efek hover pada semua gambar (kecuali stars)
    const images = document.querySelectorAll('img:not(.stars img)');
    images.forEach(img => {
      img.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.3s ease';
        this.style.transform = 'scale(1.05) rotate(2deg)';
      });
      img.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1) rotate(0deg)';
      });
    });
    
    // Animasi scroll untuk memunculkan elemen (TIDAK MEMENGARUHI PRODUK)
    const observerOptions = {
      threshold: 0.2,
      rootMargin: '0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-slide-up');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);
    
    // Observe semua section (kecuali produk karena sudah dianimasi)
    document.querySelectorAll('section:not(.product)').forEach(section => {
      observer.observe(section);
    });
  });
</script>

</body>
</html><?php /**PATH C:\laragon\www\pempekbunda75\resources\views/welcome.blade.php ENDPATH**/ ?>