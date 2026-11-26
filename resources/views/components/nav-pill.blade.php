@props(['href', 'active' => false])

<a href="{{ $href }}" @class([
    'rounded-full px-3.5 py-1.5',
    'bg-dusk text-white' => $active,
    'hover:bg-crust' => ! $active,
])>{{ $slot }}</a>
