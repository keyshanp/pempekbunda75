<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PempekBunda 75</title>

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

    @media (max-width: 360px) {
      .header { padding: 10px 15px; }
      .main-content { margin-top: 220px; }
      .hero { padding: 40px 15px; }
      html { scroll-padding-top: 200px; }
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

    @media (max-width: 360px) {
      .location { padding: 0 10px 40px 10px; }
      .maps-container {
        border-width: 3px;
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

    /* ===== SCROLL INDICATOR ANIMASI ===== */
    .scroll-indicator {
      display: flex;
      justify-content: center;
      gap: 0.5rem;
      margin-top: 1.5rem;
    }

    .indicator-dot {
      width: 0.75rem;
      height: 0.75rem;
      border-radius: 50%;
      background-color: #d1d5db;
      transition: all 0.3s ease;
      cursor: pointer;
      position: relative;
    }

    .indicator-dot.active {
      background-color: #c05c48;
      transform: scale(1.2);
      box-shadow: 0 0 10px rgba(192, 92, 72, 0.5);
    }

    .indicator-dot:hover {
      background-color: #a54534;
      transform: scale(1.1);
    }

    /* Animasi pulse untuk dot aktif */
    .indicator-dot.active {
      animation: indicatorPulse 2s ease-in-out infinite;
    }

    @keyframes indicatorPulse {
      0%, 100% {
        transform: scale(1.2);
        box-shadow: 0 0 10px rgba(192, 92, 72, 0.5);
      }
      50% {
        transform: scale(1.4);
        box-shadow: 0 0 20px rgba(192, 92, 72, 0.8);
      }
    }

    /* Responsive Product */
    @media (max-width: 1024px) {
      .product .container { padding: 0 30px; }
      .product-scroll-wrapper { padding: 0.5rem 2rem 1rem 2rem; }
    }

    @media (max-width: 768px) {
      .product { padding: 30px 0 50px 0; }
      .product .container { padding: 0 20px; }
      .product-scroll-wrapper { padding: 0.5rem 1.5rem 1rem 1.5rem; gap: 1rem; }
      .product-scroll-wrapper a,
      .product-scroll-wrapper > div { flex: 0 0 250px; }
    }

    @media (max-width: 640px) {
      .product { padding: 25px 0 40px 0; }
      .product .container { padding: 0 15px; }
      .product-scroll-wrapper { padding: 0.5rem 1rem 1rem 1rem; gap: 0.8rem; }
      .product-scroll-wrapper a,
      .product-scroll-wrapper > div { flex: 0 0 220px; }
      .product-scroll-wrapper h3 { font-size: 1rem; }
      .product-scroll-wrapper p { font-size: 1.5rem; }
    }

    @media (max-width: 480px) {
      .product { padding: 20px 0 30px 0; }
      .product .container { padding: 0 10px; }
      .product-scroll-wrapper { padding: 0.5rem 0.5rem 1rem 0.5rem; gap: 0.6rem; }
      .product-scroll-wrapper a,
      .product-scroll-wrapper > div { flex: 0 0 180px; }
      .product-scroll-wrapper h3 { font-size: 0.9rem; }
      .product-scroll-wrapper p { font-size: 1.2rem; }
    }

    @media (max-width: 360px) {
      .product { padding: 15px 0 25px 0; }
      .product .container { padding: 0 5px; }
      .product-scroll-wrapper { padding: 0.5rem 0.3rem 1rem 0.3rem; gap: 0.4rem; }
      .product-scroll-wrapper a,
      .product-scroll-wrapper > div { flex: 0 0 150px; }
      .product-scroll-wrapper h3 { font-size: 0.8rem; }
      .product-scroll-wrapper p { font-size: 1rem; }
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
    
    /* ===== REVIEWS SECTION ===== */
    .reviews {
      padding: 80px 150px;
      background: #FFF8EE;
    }
    
    .reviews-container {
      max-width: 1200px;
      margin: 0 auto;
    }
    
    /* Rating Summary */
    .rating-summary {
      background: white;
      border-radius: 20px;
      padding: 40px;
      margin-bottom: 40px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .rating-overview {
      display: grid;
      grid-template-columns: 1fr 2fr;
      gap: 40px;
      align-items: center;
    }
    
    .rating-score {
      text-align: center;
    }
    
    .score-number {
      font-size: 72px;
      font-weight: bold;
      color: #BC5A45;
      font-family: 'RASCAL', cursive;
      line-height: 1;
    }
    
    .stars-display {
      font-size: 32px;
      color: #FFD700;
      margin: 10px 0;
    }
    
    .stars-display .star {
      color: #E0E0E0;
    }
    
    .stars-display .star.filled {
      color: #FFD700;
    }
    
    .stars-display .star.half {
      background: linear-gradient(90deg, #FFD700 50%, #E0E0E0 50%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    
    .total-reviews {
      font-size: 20px;
      color: #666;
      margin-top: 10px;
      font-family: 'Reenie Beanie', cursive;
    }
    
    .rating-bars {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    
    .rating-bar-item {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .rating-label {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      min-width: 50px;
      font-family: 'Reenie Beanie', cursive;
    }
    
    .bar-container {
      flex: 1;
      height: 12px;
      background: #E0E0E0;
      border-radius: 10px;
      overflow: hidden;
    }
    
    .bar-fill {
      height: 100%;
      background: linear-gradient(90deg, #FFD700, #FFA500);
      transition: width 0.5s ease;
    }
    
    .rating-count {
      font-size: 16px;
      color: #666;
      min-width: 40px;
      text-align: right;
      font-family: 'Reenie Beanie', cursive;
    }
    
    /* Tags Summary */
    .tags-summary {
      background: white;
      border-radius: 20px;
      padding: 30px;
      margin-bottom: 40px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .tags-title {
      font-size: 32px;
      color: #BC5A45;
      margin-bottom: 20px;
      text-align: center;
    }
    
    .tags-cloud {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
    }
    
    .tag-item {
      background: linear-gradient(135deg, #BC5A45, #a54534);
      color: white;
      padding: 8px 20px;
      border-radius: 25px;
      font-family: 'Reenie Beanie', cursive;
      transition: all 0.3s ease;
      cursor: default;
    }
    
    .tag-item:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 15px rgba(188, 90, 69, 0.4);
    }
    
    .tag-count {
      font-size: 0.9em;
      opacity: 0.8;
    }
    
    /* Reviews List */
    .reviews-list {
      display: flex;
      flex-direction: column;
      gap: 25px;
    }
    
    .review-card {
      background: white;
      border-radius: 15px;
      padding: 35px;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
    }
    
    .review-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .review-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .reviewer-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .reviewer-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, #BC5A45, #a54534);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      font-weight: bold;
      font-family: 'RASCAL', cursive;
    }
    
    .reviewer-details {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }
    
    .reviewer-name {
      font-size: 24px;
      font-weight: 600;
      color: #333;
      font-family: 'Reenie Beanie', cursive;
      margin: 0;
    }
    
    .review-stars {
      font-size: 20px;
    }
    
    .review-stars .star {
      color: #E0E0E0;
    }
    
    .review-stars .star.filled {
      color: #FFD700;
    }
    
    .review-date {
      font-size: 16px;
      color: #999;
      font-family: 'Reenie Beanie', cursive;
    }
    
    .review-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 15px;
    }
    
    .review-tag {
      background: #FFF8EE;
      color: #BC5A45;
      padding: 5px 15px;
      border-radius: 15px;
      font-size: 14px;
      font-family: 'Reenie Beanie', cursive;
      border: 1px solid #BC5A45;
    }
    
    .review-text {
      font-size: 20px;
      line-height: 1.6;
      color: #555;
      font-family: 'Reenie Beanie', cursive;
    }
    
    .load-more-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      width: 100%;
      padding: 15px 30px;
      background: linear-gradient(135deg, #BC5A45, #a54534);
      color: white;
      border: none;
      border-radius: 30px;
      font-size: 24px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 20px;
    }
    
    .load-more-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(188, 90, 69, 0.4);
    }
    
    #btn-icon {
      transition: transform 0.3s ease;
    }
    
    .load-more-btn.active #btn-icon {
      transform: rotate(180deg);
    }
    
    .no-reviews {
      text-align: center;
      padding: 60px 20px;
      background: white;
      border-radius: 15px;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    }
    
    .no-reviews p {
      font-size: 28px;
      color: #999;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
      .reviews {
        padding: 60px 40px;
      }
      
      .rating-overview {
        grid-template-columns: 1fr;
        gap: 30px;
      }
    }
    
    @media (max-width: 768px) {
      .reviews {
        padding: 40px 20px;
      }
      
      .rating-summary {
        padding: 25px;
      }
      
      .score-number {
        font-size: 56px;
      }
      
      .stars-display {
        font-size: 24px;
      }
      
      .review-card {
        padding: 25px;
      }
      
      .reviewer-avatar {
        width: 50px;
        height: 50px;
        font-size: 24px;
      }
      
      .reviewer-name {
        font-size: 22px;
      }
      
      .review-stars {
        font-size: 18px;
      }
      
      .review-text {
        font-size: 18px;
      }
      
      .review-date {
        font-size: 14px;
      }
      
      .tags-cloud {
        gap: 10px;
      }
      
      .tag-item {
        font-size: 14px;
        padding: 6px 15px;
      }
    }
  </style>
</head>
<body>

<!-- HEADER - FIXED DI ATAS -->
<header class="header">
  <div class="logo-container">
    <a href="#home" class="logo-link">
      <img src="<?php echo e(asset('assets/images/logobrand.png')); ?>" alt="PempekBunda 75 Logo" class="brand-logo hover-rotate">
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
      <img src="<?php echo e(asset('assets/images/pempekbunda5.png')); ?>" alt="PempekBunda" class="hero-img animate-float">
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
        PempekBunda 75 berdiri sejak Juni 2019, terinspirasi dari pengalaman pemilik yang pernah tinggal di Palembang selama kurang lebih 20 tahun. Berawal dari pempek rumahan untuk keluarga, usaha ini berkembang karena banyak yang suka dengan rasa khasnya. Hingga sekarang, PempekBunda 75 tetap menjaga kualitas dengan ikan tenggiri murni dan cuko gula batok asli Palembang.
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
              <img src="<?php echo e(asset('assets/images/pempekbunda5.png')); ?>" alt="<?php echo e($product->nama_produk); ?>">
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
    
    <!-- Scroll Indicator (Mobile Only) - DENGAN ANIMASI SCROLL -->
    <div class="md:hidden mt-6 scroll-indicator">
      <div class="indicator-dot active" data-index="0"></div>
      <div class="indicator-dot" data-index="1"></div>
      <div class="indicator-dot" data-index="2"></div>
      <div class="indicator-dot" data-index="3"></div>
      <div class="indicator-dot" data-index="4"></div>
      <div class="indicator-dot" data-index="5"></div>
      <div class="indicator-dot" data-index="6"></div>
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
    <h2 class="section-title font-rascal animate-wobble-slow">Why PempekBunda 75</h2>
    <div class="why-content animate-fade delay-1">
      <p class="animate-slide-up delay-2">
        PempekBunda 75 dibuat untuk menghadirkan pempek dengan rasa yang konsisten dan dapat dipercaya. Setiap produk diolah dengan bahan pilihan dan proses yang terjaga, sehingga pelanggan mendapatkan kualitas yang sama di setiap pesanan. Selain rasa, PempekBunda 75 juga mengutamakan keseimbangan antara cita rasa ikan, tekstur pempek, dan karakter cuko. Perpaduan ini menjadi alasan utama mengapa produk dibuat dengan standar yang tidak berubah. PempekBunda 75 hadir sebagai pilihan pempek rumahan yang mengedepankan kualitas, kejujuran rasa, dan kepuasan pelanggan.
      </p>
    </div>
  </section>

  <!-- STARS - TIDAK DIANIMASI -->
  <div class="stars">
    <img src="<?php echo e(asset('assets/images/Stars.png')); ?>" alt="Stars">
  </div>

  <!-- CUSTOMER REVIEWS -->
  <section class="reviews" id="reviews">
    <h2 class="section-title font-rascal animate-wobble-slow">Customer Reviews</h2>
    
    <?php
        $feedbacks = \App\Models\Feedback::with('user')->latest()->get();
        $totalReviews = $feedbacks->count();
        $averageRating = $feedbacks->avg('rating') ?? 0;
        
        // Hitung distribusi rating
        $ratingCounts = [];
        for ($i = 5; $i >= 1; $i--) {
            $ratingCounts[$i] = $feedbacks->where('rating', $i)->count();
        }
        
        // Hitung tags
        $allTags = [];
        foreach ($feedbacks as $feedback) {
            if ($feedback->tags && is_array($feedback->tags)) {
                foreach ($feedback->tags as $tag) {
                    if (!isset($allTags[$tag])) {
                        $allTags[$tag] = 0;
                    }
                    $allTags[$tag]++;
                }
            }
        }
        arsort($allTags);
        
        // Ambil 5 review pertama
        $displayedReviews = $feedbacks->take(5);
        $moreReviews = $feedbacks->skip(5);
    ?>
    
    <div class="reviews-container animate-fade delay-1">
      <!-- Rating Summary -->
      <div class="rating-summary animate-slide-up delay-2">
        <div class="rating-overview">
          <div class="rating-score">
            <span class="score-number"><?php echo e(number_format($averageRating, 1)); ?></span>
            <div class="stars-display">
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($i <= floor($averageRating)): ?>
                  <span class="star filled">★</span>
                <?php elseif($i - $averageRating < 1): ?>
                  <span class="star half">★</span>
                <?php else: ?>
                  <span class="star">★</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
              <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <p class="total-reviews"><?php echo e($totalReviews); ?> Reviews</p>
          </div>
          
          <div class="rating-bars">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $ratingCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="rating-bar-item">
                <span class="rating-label"><?php echo e($rating); ?> ★</span>
                <div class="bar-container">
                  <div class="bar-fill" style="width: <?php echo e($totalReviews > 0 ? ($count / $totalReviews * 100) : 0); ?>%"></div>
                </div>
                <span class="rating-count"><?php echo e($count); ?></span>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
        </div>
      </div>
      
      <!-- Tags Summary -->
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($allTags) > 0): ?>
      <div class="tags-summary animate-slide-up delay-3">
        <h3 class="tags-title font-rascal">Popular Tags</h3>
        <div class="tags-cloud">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = array_slice($allTags, 0, 10, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="tag-item" style="font-size: <?php echo e(14 + ($count * 2)); ?>px;">
              <?php echo e($tag); ?> <span class="tag-count">(<?php echo e($count); ?>)</span>
            </span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      
      <!-- Reviews List -->
      <div class="reviews-list animate-fade delay-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($displayedReviews->count() > 0): ?>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $displayedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="review-card">
              <div class="review-header">
                <div class="reviewer-info">
                  <div class="reviewer-avatar">
                    <?php echo e(strtoupper(substr($feedback->user_name, 0, 1))); ?>

                  </div>
                  <div class="reviewer-details">
                    <h4 class="reviewer-name"><?php echo e($feedback->user_name); ?></h4>
                    <div class="review-stars">
                      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?>
                        <span class="star <?php echo e($i <= $feedback->rating ? 'filled' : ''); ?>">★</span>
                      <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                  </div>
                </div>
                <span class="review-date"><?php echo e($feedback->created_at->diffForHumans()); ?></span>
              </div>
              
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($feedback->tags && count($feedback->tags) > 0): ?>
              <div class="review-tags">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $feedback->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <span class="review-tag"><?php echo e($tag); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
              </div>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
              
              <p class="review-text"><?php echo e($feedback->review); ?></p>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($moreReviews->count() > 0): ?>
          <div id="more-reviews" style="display: none;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $moreReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="review-card">
                <div class="review-header">
                  <div class="reviewer-info">
                    <div class="reviewer-avatar">
                      <?php echo e(strtoupper(substr($feedback->user_name, 0, 1))); ?>

                    </div>
                    <div class="reviewer-details">
                      <h4 class="reviewer-name"><?php echo e($feedback->user_name); ?></h4>
                      <div class="review-stars">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?>
                          <span class="star <?php echo e($i <= $feedback->rating ? 'filled' : ''); ?>">★</span>
                        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <span class="review-date"><?php echo e($feedback->created_at->diffForHumans()); ?></span>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($feedback->tags && count($feedback->tags) > 0): ?>
                <div class="review-tags">
                  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $feedback->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="review-tag"><?php echo e($tag); ?></span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <p class="review-text"><?php echo e($feedback->review); ?></p>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
          
          <button id="load-more-btn" class="load-more-btn font-rascal" onclick="toggleMoreReviews()">
            <span id="btn-text">Load More Reviews</span>
            <span id="btn-icon">▼</span>
          </button>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php else: ?>
          <div class="no-reviews">
            <p class="font-rascal">No reviews yet. Be the first to review!</p>
          </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
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
        title="Google Maps - Lokasi PempekBunda 75"
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
      <img src="<?php echo e(asset('assets/images/logobrand.png')); ?>" alt="PempekBunda 75 Logo" class="footer-logo animate-pulse-custom hover-scale">
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
</html>
<?php /**PATH C:\laragon\www\2maretpempekbundacode\pempekbunda75\resources\views/welcome.blade.php ENDPATH**/ ?>