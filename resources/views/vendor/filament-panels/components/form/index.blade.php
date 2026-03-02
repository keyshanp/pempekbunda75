<form
    x-data="{ isUploadingFile: false }"
    x-on:submit="if (isUploadingFile) $event.preventDefault()"
    x-on:file-upload-started="isUploadingFile = true"
    x-on:file-upload-finished="isUploadingFile = false"
    {{ $attributes->class(['fi-form grid gap-y-6']) }}
>
    {{ $slot }}
    @props([
    'schema' => [],
    'statePath' => null,
])

<div {{ $attributes->class(['space-y-6']) }}>
    @foreach ($schema as $component)
        @if ($component->isVisible())
            {{ $component }}
        @endif
    @endforeach
</div>
</form>
