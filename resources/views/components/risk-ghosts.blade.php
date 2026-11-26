@props(['label', 'size' => 'size-6'])

@php
    $filled = match ($label) {
        'high' => 3,
        'medium' => 2,
        'low' => 1,
        default => 0,
    };
@endphp

<span class="flex" aria-hidden="true">
    @for ($i = 1; $i <= 3; $i++)
        <svg @class([$size, 'fill-current', 'opacity-25' => $i > $filled])><use href="#ghost"/></svg>
    @endfor
</span>
