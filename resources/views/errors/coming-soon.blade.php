<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Sedang Dalam Proses</title>

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

  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Reenie+Beanie&display=swap" rel="stylesheet">

  <!-- TAILWIND CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: 'Reenie Beanie', cursive;
      background: linear-gradient(135deg, #fef7f0 0%, #ffffff 100%);
      min-height: 100vh;
    }

    .coming-soon-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(192, 96, 68, 0.1);
      box-shadow: 0 20px 40px rgba(192, 96, 68, 0.1);
    }

    .orange-text {
      color: #C06044;
    }

    .orange-border {
      border-color: #C06044;
    }

    .orange-bg {
      background-color: #C06044;
    }

    .construction-icon {
      animation: bounce 2s infinite;
    }

    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
      }
      40% {
        transform: translateY(-10px);
      }
      60% {
        transform: translateY(-5px);
      }
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
  <div class="coming-soon-container rounded-3xl p-8 md:p-12 max-w-2xl w-full text-center">
    <!-- Icon Construction -->
    <div class="mb-8">
      <div class="construction-icon text-8xl md:text-9xl orange-text">
        🚧
      </div>
    </div>

    <!-- Title -->
    <h1 class="font-rascal text-5xl md:text-6xl orange-text mb-4">
      Halaman Sedang Dalam Proses
    </h1>

    <!-- Subtitle -->
    <p class="text-xl md:text-2xl text-gray-600 mb-8 leading-relaxed">
      Maaf, fitur ini sedang dalam pengembangan. Kami sedang bekerja keras untuk memberikan pengalaman terbaik untuk Anda.
    </p>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="{{ url('/') }}"
         class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border-2 orange-border orange-text rounded-xl font-medium hover:bg-orange-50 transition-all duration-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        Kembali ke Beranda
      </a>

      <a href="javascript:history.back()"
         class="inline-flex items-center justify-center gap-2 px-6 py-3 orange-bg text-white rounded-xl font-medium hover:bg-opacity-90 transition-all duration-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
      </a>
    </div>

    <!-- Contact Info -->
    <div class="mt-12 pt-8 border-t border-gray-200">
      <p class="text-sm text-gray-500 mb-2">Butuh bantuan?</p>
      <p class="text-sm text-gray-600">
        Hubungi kami di
        <a href="https://wa.me/6282183139218" class="orange-text hover:underline font-medium">
          WhatsApp
      </p>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-xs text-gray-400">
      <p>&copy; 2019 PempekBunda 75. All rights reserved.</p>
    </div>
  </div>

  <!-- Background Pattern -->
  <div class="fixed inset-0 pointer-events-none opacity-5">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #C06044 2px, transparent 2px), radial-gradient(circle at 75% 75%, #C06044 2px, transparent 2px); background-size: 50px 50px;"></div>
  </div>
</body>
</html>
