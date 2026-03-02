<div class="custom-stat-card">
    <div class="flex justify-between items-start mb-4">
        <div class="stat-icon-container" style="background-color: {{ $color }}1A">
            @svg($icon, 'w-6 h-6', ['style' => "color: $color"])
        </div>
        @if($trend)
            <span class="stat-trend">{{ $trend }}</span>
        @endif
    </div>
    <h3 class="stat-label">{{ $label }}</h3>
    <p class="stat-value">{{ $value }}</p>
</div>