<x-filament-widgets::widget class="fi-widget animate-fade-in">
    <div class="p-6">
        <div class="fi-widget-header">
            <h3 class="text-xl font-heading font-bold text-white mb-0">Aktivitas Terbaru</h3>
        </div>
        
        <div class="p-6 space-y-6">
            @foreach($activities as $activity)
                <div class="flex gap-4 items-start group hover:translate-x-1 transition-transform duration-300">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300 group-hover:scale-110" 
                         style="background-color: {{ $activity['icon_bg'] }}">
                        <x-filament::icon 
                            :icon="$activity['icon']" 
                            class="h-5 w-5 transition-colors duration-300"
                            style="color: {{ $activity['icon_color'] }}" 
                        />
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold font-heading text-[#4A3B34] mb-1">{{ $activity['title'] }}</p>
                        <p class="text-xs font-heading text-[#4A3B34]/60 mb-1">{{ $activity['description'] }}</p>
                        <span class="text-[10px] font-bold font-heading text-[#BC5A42]/40 uppercase tracking-wider">
                            {{ $activity['time'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="px-6 pb-6">
            <button class="w-full py-3 text-sm font-bold font-heading text-[#BC5A42] bg-[#BC5A42]/5 rounded-2xl hover:bg-[#BC5A42]/10 transition-all duration-300 hover:scale-[1.02] active:scale-95">
                Lihat Semua Log
            </button>
        </div>
    </div>
</x-filament-widgets::widget>