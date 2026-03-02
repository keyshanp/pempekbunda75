<div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900">🔥 Top Feedback Tags</h3>
            <p class="text-sm text-gray-500 mt-1">Button yang paling sering dipencet customer</p>
        </div>
        <div class="flex items-center gap-6">
            <div class="text-right">
                <span class="text-3xl font-bold text-[#BC5A42]">{{ number_format($this->getTotalFeedback()) }}</span>
                <span class="text-sm text-gray-500 block">Total Reviews</span>
            </div>
            <div class="text-right">
                <span class="text-3xl font-bold text-[#8C9440]">{{ number_format($this->getTotalTags()) }}</span>
                <span class="text-sm text-gray-500 block">Unique Tags</span>
            </div>
        </div>
    </div>

    @if(count($this->getTagStats()) > 0)
        <div class="space-y-4">
            @foreach($this->getTagStats() as $tag => $count)
                @php
                    $percentage = $this->getTotalFeedback() > 0 ? round(($count / $this->getTotalFeedback()) * 100) : 0;
                    $colors = ['#BC5A42', '#8C9440', '#E6A34F', '#4A3B34', '#C97B63', '#758E27', '#B55242', '#A6B34A'];
                    $colorIndex = $loop->index % count($colors);
                @endphp
                <div class="group">
                    <div class="flex items-center justify-between text-sm mb-1">
                        <div class="flex items-center gap-2">
                            <span class="font-medium text-gray-700">{{ $tag }}</span>
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">{{ $count }}x</span>
                        </div>
                        <span class="text-sm font-bold" style="color: {{ $colors[$colorIndex] }}">{{ $percentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="h-3 rounded-full transition-all duration-500 group-hover:scale-y-110" 
                             style="width: {{ $percentage }}%; background-color: {{ $colors[$colorIndex] }};">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Chart Visualization -->
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach(array_slice($this->getTagStats(), 0, 4, true) as $tag => $count)
                @php
                    $percentage = $this->getTotalFeedback() > 0 ? round(($count / $this->getTotalFeedback()) * 100) : 0;
                @endphp
                <div class="bg-gradient-to-br from-[#FFF8EE] to-[#FFF0E0] rounded-xl p-4 text-center border border-[#758E27]/20">
                    <div class="text-2xl mb-1">{{ explode(' ', $tag)[0] }}</div>
                    <div class="text-lg font-bold text-[#BC5A42]">{{ $count }}</div>
                    <div class="text-xs text-gray-500">{{ $percentage }}% dari total</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            <p class="text-gray-500">Belum ada data tag feedback</p>
            <p class="text-sm text-gray-400 mt-2">Customer akan memilih button saat memberikan review</p>
        </div>
    @endif
</div>