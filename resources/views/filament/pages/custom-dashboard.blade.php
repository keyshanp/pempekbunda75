<x-filament::page>
    <x-slot name="header">
        <div class="flex flex-col gap-4">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Dashboard Admin - PempekBunda 75
            </h2>
            <p class="text-gray-600">
                Selamat datang di dashboard manajemen toko PempekBunda 75
            </p>
        </div>
    </x-slot>
    
    <div class="space-y-6">
        <!-- Stats Overview -->
        @livewire(\App\Filament\Widgets\StatsOverview::class)
        
        <!-- Produk Chart -->
        @livewire(\App\Filament\Widgets\ProdukChartWidget::class)
        
        <!-- Stok Rendah -->
        @livewire(\App\Filament\Widgets\StokRendahWidget::class)
    </div>
</x-filament::page>
