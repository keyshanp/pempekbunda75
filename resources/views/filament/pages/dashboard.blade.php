<x-filament-panels::page>
    <!-- Header -->
    <div class="space-y-2 mb-8 animate-in fade-in slide-in-from-bottom-2 duration-500">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Dashboard</h2>
        <p class="text-gray-500 dark:text-gray-400">Ringkasan aktivitas penjualan toko pempek Anda.</p>
    </div>

    <!-- Stats Grid -->
    <x-filament-panels::widgets
        :widgets="$this->getHeaderWidgets()"
        :columns="$this->getHeaderWidgetsColumns()"
    />
    
    <!-- Chart & Low Stock -->
    <div class="mt-8">
        <x-filament-panels::widgets
            :widgets="$this->getFooterWidgets()"
            :columns="$this->getFooterWidgetsColumns()"
        />
    </div>

    <x-filament::page>
    <x-slot name="header">
        <div class="flex flex-col gap-4">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Dashboard Admin - PempekBunda 75
            </h2>
            <p class="text-gray-600">
                Selamat datang di dashboard manajemen toko
            </p>
        </div>
    </x-slot>
    
    <div class="space-y-6">
        <!-- Widgets akan muncul di sini -->
        <!-- Atau panggil manual: -->
        @if(method_exists($this, 'getHeaderWidgets'))
            @foreach($this->getHeaderWidgets() as $widget)
                @livewire($widget)
            @endforeach
        @endif
        
        @if(method_exists($this, 'getFooterWidgets'))
            @foreach($this->getFooterWidgets() as $widget)
                @livewire($widget)
            @endforeach
        @endif
    </div>
</x-filament::page>
    
    <!-- Quick Actions -->
    <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('filament.admin.resources.produks.create') }}" 
               class="flex items-center justify-between p-4 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/40 rounded-lg border border-blue-100 dark:border-blue-800 transition-all hover:scale-[1.02] group">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg">
                        <x-heroicon-o-plus class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                    </div>
                    <div>
                        <p class="font-semibold text-blue-700 dark:text-blue-300">Tambah Produk</p>
                        <p class="text-sm text-blue-600/70 dark:text-blue-400/70">Buat produk baru</p>
                    </div>
                </div>
                <x-heroicon-o-arrow-right class="w-5 h-5 text-blue-400 group-hover:translate-x-1 transition-transform" />
            </a>
            
            <a href="{{ route('filament.admin.resources.produks.index') }}" 
               class="flex items-center justify-between p-4 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/40 rounded-lg border border-green-100 dark:border-green-800 transition-all hover:scale-[1.02] group">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-green-100 dark:bg-green-800 rounded-lg">
                        <x-heroicon-o-shopping-bag class="w-5 h-5 text-green-600 dark:text-green-400" />
                    </div>
                    <div>
                        <p class="font-semibold text-green-700 dark:text-green-300">Kelola Produk</p>
                        <p class="text-sm text-green-600/70 dark:text-green-400/70">Lihat semua produk</p>
                    </div>
                </div>
                <x-heroicon-o-arrow-right class="w-5 h-5 text-green-400 group-hover:translate-x-1 transition-transform" />
            </a>
            
            <a href="{{ url('/') }}" target="_blank"
               class="flex items-center justify-between p-4 bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/40 rounded-lg border border-purple-100 dark:border-purple-800 transition-all hover:scale-[1.02] group">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-purple-100 dark:bg-purple-800 rounded-lg">
                        <x-heroicon-o-globe-alt class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                    </div>
                    <div>
                        <p class="font-semibold text-purple-700 dark:text-purple-300">Lihat Website</p>
                        <p class="text-sm text-purple-600/70 dark:text-purple-400/70">Kunjungi toko online</p>
                    </div>
                </div>
                <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5 text-purple-400" />
            </a>
        </div>
    </div>
</x-filament-panels::page>
