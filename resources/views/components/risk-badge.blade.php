@props(['label'])

@php
    $colors = match ($label) {
        'high' => 'bg-high-soft text-high',
        'medium' => 'bg-medium-soft text-medium',
        'low' => 'bg-low-soft text-low',
        default => 'bg-nodata-soft text-nodata',
    };
@endphp

<span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full py-1 pr-3 pl-2 text-sm font-semibold {{ $colors }}">
    <x-risk-ghosts :label="$label" size="size-4" />
    {{ $label }}
</span>
