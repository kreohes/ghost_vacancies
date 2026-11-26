@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-display text-lg font-semibold']) }}>
    {{ $value ?? $slot }}
</label>
