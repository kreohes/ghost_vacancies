@props(['status'])

@php
    $colors = match ($status) {
        'silence' => 'bg-silence-soft text-silence',
        'replied' => 'bg-replied-soft text-replied',
        'interview' => 'bg-interview-soft text-interview',
        default => 'bg-nodata-soft text-nodata',
    };
@endphp

<span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full py-1 pr-3 pl-2 align-middle text-sm font-semibold {{ $colors }}">
    <svg class="size-4" aria-hidden="true"><use href="#{{ $status }}"/></svg>{{ $status }}
</span>
