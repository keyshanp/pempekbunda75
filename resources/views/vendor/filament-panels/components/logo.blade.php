@php
    // Gunakan config() untuk mendapatkan brand name dan logo
    $brandName = config('filament.brand') ?: config('app.name');
    $brandLogo = config('filament.brand_logo');
    $brandLogoHeight = config('filament.brand_logo_height', '1.5rem');
    
    // Untuk dark mode (opsional)
    $darkModeBrandLogo = config('filament.dark_mode_brand_logo');
    $hasDarkModeBrandLogo = filled($darkModeBrandLogo);
    
    $getLogoClasses = fn (bool $isDarkMode): string => \Illuminate\Support\Arr::toCssClasses([
        'fi-logo',
        'inline-flex' => ! $hasDarkModeBrandLogo,
        'inline-flex' => $hasDarkModeBrandLogo && (! $isDarkMode),
        'hidden' => $hasDarkModeBrandLogo && $isDarkMode,
    ]);
    
    $logoStyles = "height: {$brandLogoHeight}";
@endphp

@capture($content, $logo, $isDarkMode = false)
    @if ($logo instanceof \Illuminate\Contracts\Support\Htmlable)
        <div
            {{
                $attributes
                    ->class([$getLogoClasses($isDarkMode)])
                    ->style([$logoStyles])
            }}
        >
            {{ $logo }}
        </div>
    @elseif (filled($logo))
        <img
            {{
                $attributes
                    ->class([$getLogoClasses($isDarkMode)])
                    ->style([$logoStyles])
                    ->merge([
                        'alt' => $brandName,
                        'src' => $logo,
                    ])
            }}
        />
    @else
        <div
            {{
                $attributes
                    ->class([
                        'fi-logo text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white',
                    ])
            }}
        >
            {{ $brandName }}
        </div>
    @endif
@endcapture

{{ $content($brandLogo, false) }}

@if ($hasDarkModeBrandLogo)
    {{ $content($darkModeBrandLogo, true) }}
@endif