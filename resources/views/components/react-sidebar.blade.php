<div class="w-64 h-screen bg-[#FDFBF7] border-r-2 border-[#BC5A42]/20 flex flex-col p-6 sticky top-0">
    <!-- Brand Header -->
    <div class="mb-10 flex flex-col items-center">
        <h1 class="text-3xl font-handwritten font-bold text-[#BC5A42] leading-tight">Pempek</h1>
        <h1 class="text-3xl font-handwritten font-bold text-[#BC5A42] leading-tight">Bunda 75</h1>
        <div class="mt-2 h-1 w-12 bg-[#8C9440] rounded-full"></div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 space-y-4">
        @foreach($menuItems as $item)
            <a 
                href="{{ url('/admin/' . $item['id']) }}"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300 group {{ $active === $item['id'] ? 'bg-[#BC5A42] text-white shadow-lg' : 'text-[#4A3B34] hover:bg-[#8C9440]/10' }}"
            >
                <!-- SVG Icon -->
                <svg class="w-5 h-5 {{ $active === $item['id'] ? 'text-white' : 'text-[#BC5A42]' }}" 
                     fill="none" 
                     stroke="currentColor" 
                     viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                </svg>
                <span class="font-semibold">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <!-- Footer Section -->
    <div class="mt-auto pt-6 border-t border-[#BC5A42]/10">
        <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-4 py-3 text-red-500 hover:bg-red-50 rounded-2xl transition-colors">
                <!-- Logout Icon -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="font-semibold">Keluar</span>
            </button>
        </form>
        
        <!-- Made with love -->
        <div class="mt-6 p-4 bg-[#8C9440]/5 rounded-2xl text-center">
            <p class="text-xs text-[#4A3B34] font-medium flex items-center justify-center gap-1">
                Made with 
                <svg class="w-3 h-3" fill="#BC5A42" stroke="#BC5A42" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                for Bunda
            </p>
        </div>
    </div>
</div>