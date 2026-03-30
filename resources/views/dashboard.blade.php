<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-orange-600">
                        <i class="fas fa-fish"></i> PempekBunda 75
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('transaksi.history') }}" class="text-gray-700 hover:text-orange-600">
                        <i class="fas fa-history"></i> Histori
                    </a>
                    <a href="{{ route('reviews') }}" class="text-gray-700 hover:text-orange-600">
                        <i class="fas fa-star"></i> Review
                    </a>
                    <span class="text-gray-700">{{ $user->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            <i class="fas fa-home text-orange-600"></i> Dashboard User
        </h1>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Selamat datang, {{ $user->name }}! 👋</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 mb-2">
                        <i class="fas fa-envelope text-orange-600"></i> Email: <span class="font-semibold">{{ $user->email }}</span>
                    </p>
                    <p class="text-gray-600">
                        <i class="fas fa-user-tag text-orange-600"></i> Status: 
                        <span class="font-semibold">{{ $user->is_admin ? 'Administrator' : 'User Biasa' }}</span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <a href="{{ route('produk.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="bg-orange-100 rounded-full p-3 mr-4">
                        <i class="fas fa-shopping-bag text-orange-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Produk</h3>
                        <p class="text-sm text-gray-600">Lihat semua produk</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('transaksi.history') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="bg-blue-100 rounded-full p-3 mr-4">
                        <i class="fas fa-history text-blue-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Histori Transaksi</h3>
                        <p class="text-sm text-gray-600">Lihat riwayat pembelian</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('reviews') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="bg-yellow-100 rounded-full p-3 mr-4">
                        <i class="fas fa-star text-yellow-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Review</h3>
                        <p class="text-sm text-gray-600">Lihat review pelanggan</p>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="font-semibold mb-4 text-gray-800">
                    <i class="fas fa-bolt text-orange-600"></i> Aksi Cepat
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('produk.index') }}" class="flex items-center text-gray-700 hover:text-orange-600 transition">
                            <i class="fas fa-shopping-cart mr-2"></i> Lihat Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile') }}" class="flex items-center text-gray-700 hover:text-orange-600 transition">
                            <i class="fas fa-user mr-2"></i> Profil Saya
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="flex items-center text-gray-700 hover:text-orange-600 transition">
                            <i class="fas fa-info-circle mr-2"></i> Tentang Kami
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="font-semibold mb-4 text-gray-800">
                    <i class="fas fa-crown text-orange-600"></i> Admin Panel
                </h3>
                @if($user->is_admin)
                    <a href="/admin" class="inline-flex items-center bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg transition">
                        <i class="fas fa-rocket mr-2"></i> Buka Admin Panel
                    </a>
                @else
                    <p class="text-gray-500">
                        <i class="fas fa-lock mr-2"></i> Anda bukan administrator
                    </p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>