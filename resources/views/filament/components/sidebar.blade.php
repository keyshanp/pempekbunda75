@php
    use Filament\Facades\Filament;
    $navigationItems = Filament::getNavigation();
@endphp

<div class="fi-sidebar relative flex h-screen w-full flex-col overflow-hidden bg-[#FDFBF7] border-r-2 border-[#BC5A42]/20">
    <!-- Header -->
    <div class="fi-sidebar-header mb-10 flex flex-col items-center pt-6 px-6">
        <h1 class="text-3xl font-handwritten font-bold text-[#BC5A42] leading-tight">Pempek</h1>
        <h1 class="text-3xl font-handwritten font-bold text-[#BC5A42] leading-tight">Bunda 75</h1>
        <div class="mt-2 h-1 w-12 bg-[#8C9440] rounded-full"></div>
    </div>

    <!-- Navigation -->
    <nav class="fi-sidebar-nav flex-1 space-y-4 px-6">
        @foreach ($navigationItems as $item)
            @php
                $isActive = $item->isActive();
                $icon = $item->getIcon();
                $label = $item->getLabel();
            @endphp
            
            <a 
                href="{{ $item->getUrl() }}"
                class="fi-sidebar-item group flex w-full items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300 {{ $isActive ? 'bg-[#BC5A42] text-white shadow-lg' : 'text-[#4A3B34] hover:bg-[#8C9440]/10' }}"
            >
                @if ($icon)
                    <x-filament::icon 
                        :icon="$icon" 
                        class="fi-sidebar-item-icon h-5 w-5 {{ $isActive ? 'text-white' : 'text-[#BC5A42]' }}" 
                    />
                @endif
                
                <span class="fi-sidebar-item-label font-semibold">
                    {{ $label }}
                </span>
            </a>
        @endforeach
    </nav>

    <!-- Footer -->
    <div class="fi-sidebar-footer mt-auto px-6 pt-6 border-t border-[#BC5A42]/10">
        <!-- Logout Form -->
        <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="w-full">
            @csrf
            <button 
                type="submit" 
                class="fi-sidebar-logout w-full flex items-center gap-4 px-4 py-3 text-red-500 hover:bg-red-50 rounded-2xl transition-colors"
            >
                <x-filament::icon icon="heroicon-o-arrow-right-on-rectangle" class="h-5 w-5" />
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