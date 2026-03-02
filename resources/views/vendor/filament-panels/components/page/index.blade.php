@props([
    'fullHeight' => false,
])

@php
    // JANGAN panggil method yang tidak ada
    // Cek dulu apakah method exists, baru panggil
    
    $widgetData = [];
    if (method_exists($this, 'getWidgetData')) {
        $widgetData = $this->getWidgetData();
    }
@endphp

<div
    {{
        $attributes->class([
            'fi-page',
            'h-full' => $fullHeight,
        ])
    }}
>
    @if (method_exists($this, 'getRenderHookScopes'))
        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::page.start', scopes: $this->getRenderHookScopes()) }}
    @else
        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::page.start') }}
    @endif

    <section
        @class([
            'flex flex-col gap-y-8 py-8',
            'h-full' => $fullHeight,
        ])
    >
        @if (method_exists($this, 'getHeader') && ($header = $this->getHeader()))
            {{ $header }}
        @elseif (method_exists($this, 'getHeading') && ($heading = $this->getHeading()))
            <x-filament-panels::header
                :actions="method_exists($this, 'getCachedHeaderActions') ? $this->getCachedHeaderActions() : []"
                :breadcrumbs="filament()->hasBreadcrumbs() && method_exists($this, 'getBreadcrumbs') ? $this->getBreadcrumbs() : []"
                :heading="$heading"
                :subheading="method_exists($this, 'getSubheading') ? $this->getSubheading() : null"
            />
        @endif

        {{-- Lanjutkan dengan sisa kode --}}
        {{ $slot }}
        
        @if (method_exists($this, 'getRenderHookScopes'))
            {{ \Filament\Support\Facades\FilamentView::renderHook('panels::page.end', scopes: $this->getRenderHookScopes()) }}
        @else
            {{ \Filament\Support\Facades\FilamentView::renderHook('panels::page.end') }}
        @endif
    </section>
</div>