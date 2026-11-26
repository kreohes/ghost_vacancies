@props(['label'])

@php
    $colors = match ($label) {
        'likely scam' => 'bg-high-soft text-high',
        'suspicious' => 'bg-medium-soft text-medium',
        default => 'bg-low-soft text-low',
    };
@endphp

<span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full py-1 pr-3 pl-2 align-middle text-sm font-semibold {{ $colors }}">
    <svg class="size-4" aria-hidden="true"><use href="#shield"/></svg>{{ $label }}
</span>
