@props(['status'])

@php
    $style = match ($status) {
        'silence' => 'bg-gray-800 text-white',
        'replied' => 'bg-sky-100 text-sky-800',
        'interview' => 'bg-emerald-100 text-emerald-800',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp

<span class="inline-block rounded-full px-2 py-0.5 text-xs font-semibold {{ $style }}">{{ $status }}</span>
