<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Histori Transaksi' }}</title>
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
                        <i class="fas fa-fish"></i> Pempek Bunda 75
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-gray-700">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-600">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-history text-orange-600"></i> Histori Transaksi Saya
            </h1>
            <p class="text-gray-600 mt-2">Lihat semua transaksi pembelian Anda</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($transaksis->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <i class="fas fa-receipt text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Transaksi</h3>
                <p class="text-gray-500 mb-4">Anda belum melakukan transaksi apapun</p>
                <a href="/produk" class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg transition">
                    <i class="fas fa-shopping-cart"></i> Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($transaksis as $transaksi)
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $transaksi->kode_transaksi }}</h3>
                                <p class="text-sm text-gray-500">
                                    <i class="far fa-calendar"></i> {{ $transaksi->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div>
                                @if($transaksi->status === 'success')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                        <i class="fas fa-check-circle"></i> Berhasil
                                    </span>
                                @elseif($transaksi->status === 'pending')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                @elseif($transaksi->status === 'failed')
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                                        <i class="fas fa-times-circle"></i> Gagal
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold">
                                        <i class="fas fa-ban"></i> Expired
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Kode Pesanan</p>
                                <p class="font-semibold text-gray-800">{{ $transaksi->order->kode_pesanan ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Metode Pembayaran</p>
                                <p class="font-semibold text-gray-800">
                                    {{ $transaksi->getMetodePembayaranIcon() }} {{ $transaksi->getMetodePembayaranText() }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Bayar</p>
                                <p class="font-bold text-orange-600 text-lg">Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        @if($transaksi->bukti_pembayaran)
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-2">Bukti Pembayaran</p>
                                <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" 
                                     alt="Bukti Pembayaran" 
                                     class="w-32 h-32 object-cover rounded-lg border">
                            </div>
                        @endif

                        @if($transaksi->catatan)
                            <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                <p class="text-sm text-gray-500">Catatan</p>
                                <p class="text-gray-700">{{ $transaksi->catatan }}</p>
                            </div>
                        @endif

                        <div class="flex justify-between items-center pt-4 border-t">
                            <div class="text-sm text-gray-500">
                                @if($transaksi->waktu_pembayaran)
                                    <i class="fas fa-clock"></i> Dibayar: {{ $transaksi->waktu_pembayaran->format('d M Y, H:i') }}
                                @endif
                            </div>
                            @if($transaksi->order)
                                <a href="{{ route('order.invoice', $transaksi->order->kode_pesanan) }}" 
                                   class="text-orange-600 hover:text-orange-700 font-semibold">
                                    <i class="fas fa-file-invoice"></i> Lihat Invoice
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $transaksis->links() }}
            </div>
        @endif
    </div>
</body>
</html>
