<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - PempekBunda 75</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">PempekBunda 75</a>
                <nav class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Home</a>
                    <a href="{{ route('produk.index') }}" class="text-blue-600 font-semibold">Produk</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600">Tentang Kami</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600">Kontak</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Login</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-2">Daftar Produk</h1>
        <p class="text-gray-600 mb-8">Pilih pempek favorit Anda</p>

        @if($produks->isEmpty())
            <div class="text-center py-12">
                <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada produk yang tersedia.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($produks as $produk)
                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                        @if($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                 alt="{{ $produk->nama_produk }}" 
                                 onerror="this.src='{{ asset('assets/images/pempekbunda5.png') }}';"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-box text-4xl text-gray-400"></i>
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $produk->nama_produk }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $produk->deskripsi }}</p>
                            
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-blue-600 font-bold text-lg">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $produk->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $produk->stok > 0 ? 'Stok: ' . $produk->stok : 'Stok Habis' }}
                                </span>
                            </div>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('produk.show', $produk->id) }}" 
                                   class="flex-1 bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                                </a>
                                @if($produk->stok > 0)
                                    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">PempekBunda 75</h3>
                    <p class="text-gray-300">Pempek autentik Palembang sejak 1975.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Link Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="{{ route('produk.index') }}" class="text-gray-300 hover:text-white">Produk</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('terms') }}" class="text-gray-300 hover:text-white">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-300 hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; 2019 PempekBunda 75. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
