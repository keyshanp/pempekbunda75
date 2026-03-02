<div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900">⭐ Rating Distribution</h3>
            <p class="text-sm text-gray-500 mt-1">Sebaran bintang dari customer</p>
        </div>
        <div class="flex items-center gap-6">
            <div class="text-right">
                <div class="flex items-center gap-1">
                    <span class="text-3xl font-bold text-[#FFB800]">{{ $this->getAverageRating() }}</span>
                    <span class="text-gray-400 text-sm">/5</span>
                </div>
                <span class="text-sm text-gray-500">Average Rating</span>
            </div>
            <div class="text-right">
                <span class="text-3xl font-bold text-[#8C9440]">{{ number_format($this->getTotalFeedback()) }}</span>
                <span class="text-sm text-gray-500 block">Total Reviews</span>
            </div>
        </div>
    </div>

    @if($this->getTotalFeedback() > 0)
        <!-- Pie Chart Visualization (CSS-based) -->
        <div class="flex flex-col md:flex-row items-center gap-8 mb-8">
            <div class="relative w-48 h-48">
                @php
                    $ratings = $this->getRatingDistribution();
                    $total = array_sum($ratings);
                    $colors = ['#FFB800', '#FFD966', '#FFE699', '#FFF2CC', '#FFF9E6'];
                    $startAngle = 0;
                @endphp
                
                <svg viewBox="0 0 100 100" class="transform -rotate-90 w-full h-full">
                    @foreach($ratings as $rating => $count)
                        @php
                            $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                            $angle = ($percentage / 100) * 360;
                            $endAngle = $startAngle + $angle;
                            
                            $x1 = 50 + 40 * cos(deg2rad($startAngle));
                            $y1 = 50 + 40 * sin(deg2rad($startAngle));
                            $x2 = 50 + 40 * cos(deg2rad($endAngle));
                            $y2 = 50 + 40 * sin(deg2rad($endAngle));
                            
                            $largeArcFlag = $angle > 180 ? 1 : 0;
                        @endphp
                        
                        @if($percentage > 0)
                            <path d="M 50 50 L {{ $x1 }} {{ $y1 }} A 40 40 0 {{ $largeArcFlag }} 1 {{ $x2 }} {{ $y2 }} Z" 
                                  fill="{{ $colors[$loop->index] }}" 
                                  stroke="white" 
                                  stroke-width="1">
                                <title>{{ $rating }} ⭐: {{ $count }} ({{ round($percentage, 1) }}%)</title>
                            </path>
                        @endif
                        
                        @php $startAngle = $endAngle; @endphp
                    @endforeach
                    
                    <circle cx="50" cy="50" r="25" fill="white" stroke="white" stroke-width="2"/>
                </svg>
                
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-[#FFB800]">{{ $this->getAverageRating() }}</div>
                        <div class="text-xs text-gray-500">rata-rata</div>
                    </div>
                </div>
            </div>
            
            <div class="flex-1 space-y-3 w-full">
                @foreach([5,4,3,2,1] as $rating)
                    @php
                        $count = $this->getRatingDistribution()[$rating] ?? 0;
                        $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
                    @endphp
                    <div class="group">
                        <div class="flex items-center gap-3 text-sm mb-1">
                            <div class="flex items-center gap-1 w-20">
                                <span class="font-bold">{{ $rating }}</span>
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 h-3 {{ $i <= $rating ? 'text-[#FFB800]' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">{{ $count }} reviews</span>
                            <span class="text-sm font-bold text-[#BC5A42] ml-auto">{{ $percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                            <div class="h-2.5 rounded-full transition-all duration-500 bg-gradient-to-r from-[#FFB800] to-[#FFD700]" 
                                 style="width: {{ $percentage }}%;">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            <p class="text-gray-500">Belum ada data rating</p>
            <p class="text-sm text-gray-400 mt-2">Customer akan memberikan rating saat review</p>
        </div>
    @endif
</div>