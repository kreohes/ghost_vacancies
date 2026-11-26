@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-2xl border-2 border-crust bg-white px-4 py-2.5 hover:border-fern focus:border-fern focus:outline-2 focus:outline-offset-2 focus:outline-fern']) }}>
