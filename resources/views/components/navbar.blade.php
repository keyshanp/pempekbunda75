<nav class="w-full py-4 md:py-6 px-6 md:px-16 flex justify-between items-center bg-white/90 backdrop-blur-sm sticky top-0 z-50 shadow-sm">
    <!-- Logo -->
    <div class="flex items-center gap-2">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 md:w-10 md:h-10 bg-bean rounded-full flex items-center justify-center">
                <span class="text-white font-bold text-lg md:text-xl">PB</span>
            </div>
            <span class="text-xl md:text-2xl reenie-beanie text-deepred">Pempek Bunda 75</span>
        </a>
    </div>
    
    <!-- Desktop Navigation -->
    <div class="hidden md:flex items-center space-x-6 lg:space-x-8 reenie-beanie text-xl md:text-2xl text-black/80">
        <a href="{{ route('home') }}" 
           class="cursor-pointer hover:text-terracotta transition-colors {{ request()->routeIs('home') ? 'border-b-2 border-black pb-0.5' : '' }}">
            home
        </a>
        <a href="{{ route('produk.index') }}" 
           class="cursor-pointer hover:text-terracotta transition-colors {{ request()->routeIs('produk.*') ? 'border-b-2 border-black pb-0.5' : '' }}">
            produk
        </a>
        
        @auth
            <a href="{{ route('order.my-orders') }}" 
               class="cursor-pointer hover:text-terracotta transition-colors {{ request()->routeIs('order.my-orders') ? 'border-b-2 border-black pb-0.5' : '' }}">
                pesanan saya
            </a>
            <a href="{{ route('transaksi.history') }}" 
               class="cursor-pointer hover:text-terracotta transition-colors {{ request()->routeIs('transaksi.history') ? 'border-b-2 border-black pb-0.5' : '' }}">
                histori transaksi
            </a>
        @endauth
        
        <a href="{{ route('order.cart') }}" class="cursor-pointer">
            <button class="bg-terracotta text-white px-6 py-2 rounded-full hover:bg-[#b55242] transition-colors shadow-sm reenie-beanie text-xl">
                order
            </button>
        </a>
        
        <!-- Cart Icon -->
        <a href="{{ route('order.cart') }}" class="text-terracotta hover:text-deepred transition-colors relative">
            <i class="fas fa-shopping-cart text-2xl"></i>
            @if(session('cart') && array_sum(array_column(session('cart'), 'quantity')) > 0)
                <span id="cart-count" class="absolute -top-2 -right-2 bg-bean text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    {{ array_sum(array_column(session('cart'), 'quantity')) }}
                </span>
            @endif
        </a>
        
        <!-- Auth Links -->
        @auth
            <div class="relative group">
                <button class="flex items-center gap-2 text-gray-700 hover:text-terracotta transition-colors">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <span class="reenie-beanie text-lg">{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 hidden group-hover:block z-50 border border-gray-200">
                    <div class="px-4 py-2 border-b border-gray-200">
                        <p class="text-sm font-semibold text-gray-700">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 reenie-beanie text-lg text-gray-700">
                        <i class="fas fa-tachometer-alt mr-2 text-terracotta"></i> Dashboard
                    </a>
                    <a href="{{ route('order.my-orders') }}" class="block px-4 py-2 hover:bg-gray-100 reenie-beanie text-lg text-gray-700">
                        <i class="fas fa-receipt mr-2 text-terracotta"></i> Pesanan Saya
                    </a>
                    <a href="{{ route('transaksi.history') }}" class="block px-4 py-2 hover:bg-gray-100 reenie-beanie text-lg text-gray-700">
                        <i class="fas fa-history mr-2 text-terracotta"></i> Histori Transaksi
                    </a>
                    <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100 reenie-beanie text-lg text-gray-700">
                        <i class="fas fa-user mr-2 text-terracotta"></i> Profile
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="block border-t border-gray-200 mt-2 pt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600 reenie-beanie text-lg transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="cursor-pointer">
                <button class="bg-bean text-white px-6 py-2 rounded-full hover:bg-[#7a7d38] transition-colors shadow-sm reenie-beanie text-xl">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                </button>
            </a>
        @endauth
    </div>
    
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button" class="md:hidden text-2xl text-gray-700">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="md:hidden absolute top-full left-0 right-0 bg-white shadow-lg py-4 px-6 hidden z-40">
        <div class="flex flex-col space-y-3">
            <a href="{{ route('home') }}" 
               class="text-xl reenie-beanie py-2 border-b border-gray-100 {{ request()->routeIs('home') ? 'text-terracotta' : 'text-gray-700' }}">
                <i class="fas fa-home mr-2"></i> Home
            </a>
            <a href="{{ route('produk.index') }}" 
               class="text-xl reenie-beanie py-2 border-b border-gray-100 {{ request()->routeIs('produk.*') ? 'text-terracotta' : 'text-gray-700' }}">
                <i class="fas fa-box mr-2"></i> Produk
            </a>
            <a href="{{ route('order.cart') }}" 
               class="text-xl reenie-beanie py-2 border-b border-gray-100 flex items-center justify-between">
                <span><i class="fas fa-shopping-cart mr-2"></i> Keranjang</span>
                @if(session('cart') && array_sum(array_column(session('cart'), 'quantity')) > 0)
                    <span class="bg-bean text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        {{ array_sum(array_column(session('cart'), 'quantity')) }}
                    </span>
                @endif
            </a>
            
            @auth
                <div class="border-t border-gray-200 pt-3 mt-2">
                    <p class="text-sm font-semibold text-gray-700 px-2 mb-2">{{ auth()->user()->name }}</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-xl reenie-beanie py-2 border-b border-gray-100 text-gray-700">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('order.my-orders') }}" class="text-xl reenie-beanie py-2 border-b border-gray-100 text-gray-700">
                    <i class="fas fa-receipt mr-2"></i> Pesanan Saya
                </a>
                <a href="{{ route('transaksi.history') }}" class="text-xl reenie-beanie py-2 border-b border-gray-100 text-gray-700">
                    <i class="fas fa-history mr-2"></i> Histori Transaksi
                </a>
                <a href="{{ route('profile') }}" class="text-xl reenie-beanie py-2 border-b border-gray-100 text-gray-700">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left text-xl reenie-beanie py-2 text-red-600 hover:bg-red-50 rounded px-2 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-xl reenie-beanie py-2 border-b border-gray-100 text-gray-700">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('mobile-menu');
        const button = document.getElementById('mobile-menu-button');
        
        if (!menu.contains(event.target) && !button.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>