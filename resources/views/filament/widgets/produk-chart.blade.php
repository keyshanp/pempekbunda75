<x-filament-widgets::widget class="fi-widget animate-fade-in">
    <div class="p-0 overflow-hidden rounded-3xl">
        <!-- HEADER DENGAN GRADIENT -->
        <div class="fi-widget-header">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6">
                <div>
                    <h3 class="text-2xl font-heading font-bold text-white mb-1">📈 Statistik Penjualan</h3>
                    <p class="text-white/80 text-sm font-heading">Performansi penjualan 7 bulan terakhir</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-2xl">
                        <span class="text-white text-sm font-heading font-bold">{{ $growth }}</span>
                        <span class="text-white/70 text-xs font-heading ml-2">vs bulan lalu</span>
                    </div>
                    <select class="bg-white/20 text-white border-none rounded-2xl px-4 py-2 text-sm font-heading focus:ring-2 focus:ring-white/30">
                        <option class="text-gray-800">7 Bulan Terakhir</option>
                        <option class="text-gray-800">Tahun Ini</option>
                        <option class="text-gray-800">Tahun Lalu</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- CHART AREA -->
        <div class="p-6 bg-gradient-to-b from-[#FDFBF7] to-white">
            <!-- BAR CHART VISUAL -->
            <div class="mb-8">
                <div class="flex items-end h-64 gap-3 mb-6 px-4">
                    @foreach($months as $month)
                        @php
                            $maxSales = max(array_column($months, 'sales'));
                            $height = ($month['sales'] / $maxSales) * 100;
                            $barColor = $month['color'];
                        @endphp
                        <div class="flex-1 flex flex-col items-center group relative">
                            <!-- Bar -->
                            <div 
                                class="w-12 md:w-16 rounded-t-2xl transition-all duration-500 hover:opacity-90 cursor-pointer group-hover:w-20 group-hover:shadow-2xl relative"
                                style="height: {{ $height }}%; background: linear-gradient(to top, {{ $barColor }}, {{ $barColor }}dd);"
                            >
                                <!-- Hover Tooltip -->
                                <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-all duration-300 bg-[#4A3B34] text-white px-3 py-2 rounded-xl text-sm font-heading whitespace-nowrap z-50 shadow-2xl">
                                    <div class="font-bold">{{ $month['name'] }}</div>
                                    <div class="text-xs">Rp {{ number_format($month['sales'], 0, ',', '.') }}</div>
                                    <div class="text-xs text-white/70">{{ $month['orders'] }} pesanan</div>
                                    <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-[#4A3B34] rotate-45"></div>
                                </div>
                            </div>
                            
                            <!-- Month Label -->
                            <div class="mt-3 text-center">
                                <div class="text-lg font-heading font-bold text-[#4A3B34]">{{ $month['name'] }}</div>
                                <div class="text-xs font-heading text-[#BC5A42] font-bold">
                                    {{ number_format($month['sales'] / 1000000, 1) }}JT
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Grid Lines -->
                <div class="relative h-px bg-gradient-to-r from-transparent via-[#BC5A42]/20 to-transparent mt-2">
                    @for($i = 0; $i <= 4; $i++)
                        <div class="absolute left-0 right-0 h-px bg-[#BC5A42]/10" style="top: {{ $i * 25 }}%"></div>
                        <div class="absolute left-4 text-xs font-heading text-[#4A3B34]/60" style="top: {{ $i * 25 }}%; transform: translateY(-50%)">
                            @php
                                $value = $maxSales * (1 - ($i * 0.25));
                            @endphp
                            Rp {{ number_format($value / 1000000, 1) }}JT
                        </div>
                    @endfor
                </div>
            </div>
            
            <!-- SUMMARY CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white border-2 border-[#8C9440]/10 rounded-2xl p-4 hover:border-[#BC5A42] transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#BC5A42]/10 flex items-center justify-center">
                            <span class="text-[#BC5A42] text-lg">💰</span>
                        </div>
                        <div>
                            <p class="text-xs font-heading text-[#4A3B34]/60">Total Penjualan</p>
                            <p class="text-lg font-heading font-bold text-[#BC5A42]">{{ $total_sales }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-[#8C9440]/10 rounded-2xl p-4 hover:border-[#BC5A42] transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#8C9440]/10 flex items-center justify-center">
                            <span class="text-[#8C9440] text-lg">📊</span>
                        </div>
                        <div>
                            <p class="text-xs font-heading text-[#4A3B34]/60">Rata-rata/Bulan</p>
                            <p class="text-lg font-heading font-bold text-[#8C9440]">{{ $avg_sales }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-[#8C9440]/10 rounded-2xl p-4 hover:border-[#BC5A42] transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#E6A34F]/10 flex items-center justify-center">
                            <span class="text-[#E6A34F] text-lg">🏆</span>
                        </div>
                        <div>
                            <p class="text-xs font-heading text-[#4A3B34]/60">Bulan Terbaik</p>
                            <p class="text-lg font-heading font-bold text-[#E6A34F]">{{ $best_month }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-[#8C9440]/10 rounded-2xl p-4 hover:border-[#BC5A42] transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center">
                            <span class="text-green-600 text-lg">📈</span>
                        </div>
                        <div>
                            <p class="text-xs font-heading text-[#4A3B34]/60">Pertumbuhan</p>
                            <p class="text-lg font-heading font-bold text-green-600">{{ $growth }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <style>
        .fi-widget-header {
            background: linear-gradient(135deg, #8C9440 0%, #7C8430 100%) !important;
            border-bottom: 3px solid #BC5A42 !important;
        }
        
        /* Smooth hover effects */
        .group:hover .group-hover\:w-20 {
            width: 5rem !important;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #FDFBF7;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #BC5A42;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #9C4A32;
        }
    </style>
</x-filament-widgets::widget>