@props([
    'action' => null,
    'badge' => null,
    'badgeColor' => null,
    'badgeIcon' => null,
    'badgeIconPosition' => 'before',
    'color' => 'gray',
    'disabled' => false,
    'form' => null,
    'grouped' => false,
    'href' => null,
    'icon' => 'heroicon-o-arrow-left-on-rectangle',
    'iconAlias' => null,
    'iconPosition' => 'before',
    'iconSize' => null,
    'keyBindings' => null,
    'label' => 'Logout',
    'loadingIndicator' => true,
    'outlined' => false,
    'size' => 'md',
    'tag' => 'button',
    'target' => null,
    'tooltip' => 'Keluar dari sistem',
    'type' => 'button',
])

<form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="w-full">
    @csrf
    <button
        type="submit"
        class="flex items-center gap-3 w-full px-4 py-3 text-left hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors group"
    >
        <!-- Icon -->
        <div class="relative">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#BC5A42] to-[#8C9440] flex items-center justify-center text-white shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
            
            <!-- Notification dot (optional) -->
            <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></div>
        </div>
        
        <!-- Text -->
        <div class="flex-1">
            <p class="font-semibold text-gray-900 dark:text-white group-hover:text-[#BC5A42] transition-colors">
                Keluar
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Klik untuk logout dari sistem
            </p>
        </div>
        
        <!-- Arrow -->
        <svg class="w-5 h-5 text-gray-400 group-hover:text-[#BC5A42] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</form>