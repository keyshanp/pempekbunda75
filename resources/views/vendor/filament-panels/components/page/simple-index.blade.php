@props([
    'fullHeight' => false,
])

<div
    {{
        $attributes->class([
            'fi-page',
            'h-full' => $fullHeight,
        ])
    }}
>
    <section
        @class([
            'flex flex-col gap-y-8 py-8',
            'h-full' => $fullHeight,
        ])
    >
        {{ $slot }}
    </section>
</div>