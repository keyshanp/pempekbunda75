@auth
<div class="mt-auto px-4 pb-6">
    <!-- User Card -->
    <div class="bg-gradient-to-r from-[#BC5A42]/10 to-[#8C9440]/10 rounded-2xl p-4 border border-[#BC5A42]/20 mb-4">
        <div class="flex items-center gap-3 mb-3">
            <!-- Avatar -->
            <div class="relative">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#BC5A42] to-[#8C9440] flex items-center justify-center text-white font-bold text-lg shadow-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
            </div>
            
            <!-- Info -->
            <div class="flex-1">
                <p class="font-bold text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
            </div>
        </div>
        
        <!-- Status -->
        <div class="flex items-center justify-between">
            <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Online
            </span>
            
            <span class="text-xs text-gray-500">
                {{ now()->format('H:i') }}
            </span>
        </div>
    </div>
    
    <!-- Logout Button -->
    <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="w-full">
        @csrf
        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border-2 border-[#BC5A42] text-[#BC5A42] rounded-xl font-semibold hover:bg-[#BC5A42] hover:text-white transition-all duration-300 hover:scale-[1.02] active:scale-95 shadow-sm hover:shadow-lg"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span>Keluar</span>
        </button>
    </form>
    
    <!-- Made with love -->
    <div class="mt-6 text-center">
        <p class="text-xs text-gray-500 flex items-center justify-center gap-1">
            Made with 
            <svg class="w-3 h-3 text-[#BC5A42]" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
            </svg>
            for Bunda
        </p>
        <p class="text-xs text-gray-400 mt-1">© 2019 PempekBunda 75</p>
    </div>
</div>
@endauth
