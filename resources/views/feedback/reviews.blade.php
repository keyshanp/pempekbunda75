<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Review Pelanggan' }}</title>
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
                        <a href="{{ route('transaksi.history') }}" class="text-gray-700 hover:text-orange-600">
                            <i class="fas fa-history"></i> Histori
                        </a>
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
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-star text-yellow-500"></i> Review Pelanggan
            </h1>
            <p class="text-gray-600 mt-2">Lihat apa kata pelanggan kami tentang produk Pempek Bunda 75</p>
        </div>

        <!-- Filter & Stats -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="text-4xl font-bold text-orange-600">{{ number_format($averageRating, 1) }}</div>
                    <div class="text-yellow-500 text-xl">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($averageRating))
                                <i class="fas fa-star"></i>
                            @elseif($i - $averageRating < 1)
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <p class="text-sm text-gray-500 mt-1">{{ $totalReviews }} Review</p>
                </div>
                @foreach([5,4,3,2,1] as $star)
                    <div class="flex items-center">
                        <span class="text-sm font-semibold w-8">{{ $star }} <i class="fas fa-star text-yellow-500 text-xs"></i></span>
                        <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $totalReviews > 0 ? ($ratingCounts[$star] ?? 0) / $totalReviews * 100 : 0 }}%"></div>
                        </div>
                        <span class="text-sm text-gray-600 w-8">{{ $ratingCounts[$star] ?? 0 }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        @if($feedbacks->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <i class="fas fa-comments text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Review</h3>
                <p class="text-gray-500">Jadilah yang pertama memberikan review!</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($feedbacks as $feedback)
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    {{ strtoupper(substr($feedback->user_name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-gray-800">{{ $feedback->user_name }}</h3>
                                        <div class="text-yellow-500">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $feedback->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span class="text-gray-600 text-sm ml-2">{{ $feedback->rating }}/5</span>
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-500">
                                        <i class="far fa-calendar"></i> {{ $feedback->created_at->format('d M Y') }}
                                    </span>
                                </div>

                                @if($feedback->tags && count($feedback->tags) > 0)
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        @foreach($feedback->tags as $tag)
                                            <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-semibold">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <p class="text-gray-700 leading-relaxed">{{ $feedback->review }}</p>

                                <div class="mt-3 pt-3 border-t text-sm text-gray-500">
                                    <i class="fas fa-receipt"></i> Order: <span class="font-semibold">{{ $feedback->kode_pesanan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $feedbacks->links() }}
            </div>
        @endif
    </div>
</body>
</html>
