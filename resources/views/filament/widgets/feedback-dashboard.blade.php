<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+{{ $this->getThisMonthCount() }} this month</span>
                </div>
                <p class="text-sm text-gray-500">Total Feedback</p>
                <p class="text-3xl font-bold mt-1">{{ number_format($this->getTotalFeedback()) }}</p>
            </div>
            
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">Avg</span>
                </div>
                <p class="text-sm text-gray-500">Average Rating</p>
                <p class="text-3xl font-bold mt-1">{{ $this->getAverageRating() }} / 5</p>
            </div>
            
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <div class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-1 rounded-full">Total</span>
                </div>
                <p class="text-sm text-gray-500">Unique Tags</p>
                <p class="text-3xl font-bold mt-1">{{ count($this->getTagStats()) }}</p>
            </div>
            
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">5 ⭐</span>
                </div>
                <p class="text-sm text-gray-500">5 Star Reviews</p>
                <p class="text-3xl font-bold mt-1">{{ $this->getRatingDistribution()[5] ?? 0 }}</p>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Monthly Trends Chart -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Monthly Trends</h3>
                <p class="text-sm text-gray-500 mb-6">Feedback volume over time</p>
                
                @php
                    $monthlyStats = $this->getMonthlyStats();
                    $maxCount = $monthlyStats->max('count') ?: 1;
                @endphp
                
                <div class="h-64 flex items-end justify-between gap-2">
                    @foreach($monthlyStats as $stat)
                        @php
                            $height = $stat->count > 0 ? ($stat->count / $maxCount) * 100 : 5;
                        @endphp
                        <div class="flex-1 flex flex-col items-center group">
                            <div class="relative w-full flex justify-center">
                                <div class="w-full max-w-[40px] bg-gradient-to-t from-indigo-600 to-indigo-400 rounded-t-lg transition-all duration-300 group-hover:from-indigo-700 group-hover:to-indigo-500"
                                     style="height: {{ $height }}px;">
                                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 bg-gray-800 text-white text-xs rounded px-2 py-1 whitespace-nowrap">
                                        {{ $stat->count }} reviews
                                    </div>
                                </div>
                            </div>
                            <span class="mt-2 text-xs text-gray-600">{{ $stat->month }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tag Distribution Chart -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Review Tags Distribution</h3>
                <p class="text-sm text-gray-500 mb-6">Most frequently used review buttons</p>
                
                <div class="space-y-3 max-h-[300px] overflow-y-auto pr-2">
                    @forelse(array_slice($this->getTagStats(), 0, 10) as $tag => $count)
                        @php
                            $total = $this->getTotalFeedback();
                            $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
                        @endphp
                        <div>
                            <div class="flex items-center justify-between text-sm mb-1">
                                <span class="font-medium text-gray-700 truncate max-w-[200px]">{{ $tag }}</span>
                                <span class="text-xs font-bold text-indigo-600">{{ $percentage }}% ({{ $count }})</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                <div class="h-2 rounded-full bg-indigo-600" style="width: {{ $percentage }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Belum ada data tag</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Rating Distribution Pie Chart -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Rating Distribution</h3>
                <p class="text-sm text-gray-500 mb-6">How customers rate your service</p>
                
                @php
                    $ratings = $this->getRatingDistribution();
                    $total = array_sum($ratings);
                    $colors = ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6'];
                @endphp
                
                @if($total > 0)
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <!-- Simple Pie Chart (CSS-based) -->
                    <div class="relative w-48 h-48">
                        <div class="absolute inset-0 rounded-full overflow-hidden">
                            @php
                                $startAngle = 0;
                                $ratingLevels = [5,4,3,2,1];
                            @endphp
                            
                            @foreach($ratingLevels as $index => $rating)
                                @php
                                    $count = $ratings[$rating] ?? 0;
                                    $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                                    $angle = ($percentage / 100) * 360;
                                @endphp
                                
                                @if($percentage > 0)
                                    <div class="absolute inset-0 origin-center"
                                         style="transform: rotate({{ $startAngle }}deg); 
                                                clip-path: polygon(50% 50%, 50% 0, {{ 50 + 50 * cos(deg2rad($angle)) }}% {{ 50 - 50 * sin(deg2rad($angle)) }}%, 50% 50%); 
                                                background-color: {{ $colors[$index] }};">
                                    </div>
                                @endif
                                
                                @php $startAngle += $angle; @endphp
                            @endforeach
                            
                            <div class="absolute inset-2 bg-white rounded-full flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-indigo-600">{{ $this->getAverageRating() }}</div>
                                    <div class="text-xs text-gray-500">average</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Legend -->
                    <div class="flex-1 space-y-2">
                        @foreach([5,4,3,2,1] as $rating)
                            @php
                                $count = $ratings[$rating] ?? 0;
                                $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
                            @endphp
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg" style="background-color: {{ $colors[5-$rating] }}"></div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium">{{ $rating }} Star</span>
                                        <span class="text-sm text-gray-600">{{ $count }} ({{ $percentage }}%)</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2 mt-1">
                                        <div class="h-2 rounded-full" style="width: {{ $percentage }}%; background-color: {{ $colors[5-$rating] }};"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @else
                    <p class="text-center text-gray-500 py-8">Belum ada data rating</p>
                @endif
            </div>
        </div>

        <!-- Feedback Table -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Recent Feedback</h3>
                    <p class="text-sm text-gray-500">Latest customer reviews</p>
                </div>
                <a href="{{ url('/admin/feedback') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                    View All
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            {{ $this->table }}
        </div>
    </div>
</x-filament-panels::page>