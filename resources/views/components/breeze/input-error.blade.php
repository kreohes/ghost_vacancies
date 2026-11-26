@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'inline-block rounded-2xl bg-high-soft px-4 py-2 text-sm font-semibold text-high space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
