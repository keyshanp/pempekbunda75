@php
    $user = filament()->auth()->user();
    $avatar = $user->avatar_url ?? null;
    $name = $user->name;
    $email = $user->email;
    $initials = strtoupper(substr($name, 0, 2));
@endphp

<div class="relative" x-data="{ open: false }">
    <!-- Trigger Button -->
    <button
        @click="open = !open"
        class="flex items-center gap-3 p-2 rounded-xl hover:bg-white/10 transition-colors group"
    >
        <!-- Avatar -->
        <div class="relative">
            @if($avatar)
                <img 
                    src="{{ $avatar }}" 
                    alt="{{ $name }}"
                    class="w-10 h-10 rounded-full border-2 border-white/30 group-hover:border-[#BC5A42] transition-colors"
                >
            @else
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#BC5A42] to-[#8C9440] flex items-center justify-center text-white font-bold shadow-lg group-hover:scale-105 transition-transform">
                    {{ $initials }}
                </div>
            @endif
            
            <!-- Online indicator -->
            <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
        </div>
        
        <!-- User Info -->
        <div class="hidden lg:block text-left">
            <p class="font-semibold text-white text-sm leading-tight">{{ $name }}</p>
            <p class="text-xs text-gray-300">{{ $email }}</p>
        </div>
        
        <!-- Chevron -->
        <svg 
            class="w-5 h-5 text-gray-300 group-hover:text-[#BC5A42] transition-colors"
            :class="{ 'rotate-180': open }"
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    
    <!-- Dropdown Menu -->
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50"
        style="display: none;"
    >
        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
            <p class="font-bold text-gray-900 dark:text-white">{{ $name }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $email }}</p>
        </div>
        
        <!-- Menu Items -->
        <div class="py-2">
            <!-- Profile -->
            <a
                href="{{ filament()->getProfileUrl() }}"
                class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group"
            >
                <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-700 dark:text-gray-300 group-hover:text-[#BC5A42] transition-colors">Profile Saya</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Edit profile & password</p>
                </div>
            </a>
            
            <!-- Settings -->
            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group"
            >
                <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 3 3 3 0 016 3z" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-700 dark:text-gray-300 group-hover:text-[#BC5A42] transition-colors">Pengaturan</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Customize dashboard</p>
                </div>
            </a>
            
            <!-- Divider -->
            <div class="my-2 border-t border-gray-100 dark:border-gray-700"></div>
            
            <!-- Logout -->
            <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="w-full">
                @csrf
                <button
                    type="submit"
                    class="flex items-center gap-3 w-full px-4 py-3 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors group text-left"
                >
                    <div class="w-8 h-8 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700 dark:text-gray-300 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">Keluar</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Logout dari sistem</p>
                    </div>
                </button>
            </form>
        </div>
        
        <!-- Footer -->
        <div class="px-4 py-2 border-t border-gray-100 dark:border-gray-700 text-center">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                PempekBunda 75 • v2.0
            </p>
        </div>
    </div>
</div>
