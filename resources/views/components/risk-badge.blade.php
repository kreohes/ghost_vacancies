@props(['label'])

@php
    $colors = match ($label) {
        'high' => 'bg-red-100 text-red-800',
        'medium' => 'bg-amber-100 text-amber-800',
        'low' => 'bg-green-100 text-green-800',
        default => 'bg-gray-100 text-gray-600',
    };
@endphp

<span class="inline-block whitespace-nowrap rounded-full px-2 py-0.5 text-xs font-semibold {{ $colors }}">{{ $label }}</span>
