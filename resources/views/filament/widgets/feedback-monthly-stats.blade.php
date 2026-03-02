<div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900">📊 Trend Feedback (6 Bulan Terakhir)</h3>
            <p class="text-sm text-gray-500 mt-1">Perkembangan jumlah review per bulan</p>
        </div>
        <div class="flex items-center gap-6">
            <div class="text-right">
                <span class="text-3xl font-bold text-[#BC5A42]">{{ number_format($this->getTotal6Months()) }}</span>
                <span class="text-sm text-gray-500 block">Total 6 Bulan</span>
            </div>
            <div class="text-right">
                <span class="text-3xl font-bold text-[#8C9440]">{{ $this->getAveragePerMonth() }}</span>
                <span class="text-sm text-gray-500 block">Rata-rata/Bulan</span>
            </div>
        </div>
    </div>

    @php
        $monthlyStats = $this->getMonthlyStats();
        $hasData = array_sum($monthlyStats) > 0;
    @endphp

    @if($hasData)
        <!-- Growth Indicator -->
        @php
            $growth = $this->getGrowth();
        @endphp
        <div class="mb-6 flex items-center gap-2 text-sm">
            <span class="text-gray-500">Perbandingan bulan ini dengan bulan lalu:</span>
            @if($growth['trend'] == 'up')
                <span class="text-green-600 font-bold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    Naik {{ $growth['percentage'] }}%
                </span>
            @elseif($growth['trend'] == 'down')
                <span class="text-red-600 font-bold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                    </svg>
                    Turun {{ abs($growth['percentage']) }}%
                </span>
            @else
                <span class="text-gray-600 font-bold">Stabil</span>
            @endif
        </div>

        <!-- Bar Chart -->
        <div class="h-64 flex items-end justify-between gap-2 mb-4">
            @foreach($monthlyStats as $month => $count)
                @php
                    $height = $count > 0 ? ($count / $this->getMaxCount()) * 100 : 5;
                    $isHighest = $count == $this->getMaxCount() && $count > 0;
                    $isLowest = $count == min($monthlyStats) && $count > 0 && !$isHighest;
                @endphp
                <div class="flex-1 flex flex-col items-center group">
                    <div class="relative w-full flex justify-center">
                        <div class="w-full max-w-[60px] bg-gradient-to-t from-[#BC5A42] to-[#C97B63] rounded-t-lg transition-all duration-300 group-hover:from-[#8C9440] group-hover:to-[#A6B34A] relative"
                             style="height: {{ $height }}px;">
                            
                            <!-- Tooltip -->
                            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-800 text-white text-xs rounded px-2 py-1 whitespace-nowrap">
                                {{ $count }} reviews
                            </div>
                            
                            <!-- Badge untuk nilai tertinggi -->
                            @if($isHighest)
                                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                    <span class="text-xs font-bold text-[#BC5A42] bg-[#BC5A42]/10 px-2 py-1 rounded-full">🔥 Tertinggi</span>
                                </div>
                            @endif
                            
                            <!-- Badge untuk nilai terendah -->
                            @if($isLowest)
                                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                    <span class="text-xs font-bold text-[#8C9440] bg-[#8C9440]/10 px-2 py-1 rounded-full">📉 Terendah</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <span class="text-sm font-bold text-gray-700">{{ $count }}</span>
                        <p class="text-xs text-gray-500 mt-1">{{ $month }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-3 gap-4 pt-6 border-t border-gray-100">
            <div class="text-center p-3 bg-[#FFF8EE] rounded-xl">
                <span class="text-sm text-gray-500">Bulan Terbaik</span>
                <div class="font-bold text-[#BC5A42]">
                    @php
                        $maxMonth = array_search($this->getMaxCount(), $monthlyStats);
                    @endphp
                    {{ $maxMonth }} ({{ $this->getMaxCount() }})
                </div>
            </div>
            <div class="text-center p-3 bg-[#FFF8EE] rounded-xl">
                <span class="text-sm text-gray-500">Total Reviews</span>
                <div class="font-bold text-[#8C9440]">{{ $this->getTotal6Months() }}</div>
            </div>
            <div class="text-center p-3 bg-[#FFF8EE] rounded-xl">
                <span class="text-sm text-gray-500">Rata-rata</span>
                <div class="font-bold text-[#E6A34F]">{{ $this->getAveragePerMonth() }}/bulan</div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <p class="text-gray-500">Belum ada data feedback dalam 6 bulan terakhir</p>
            <p class="text-sm text-gray-400 mt-2">Data akan muncul setelah customer memberikan review</p>
        </div>
    @endif
</div>