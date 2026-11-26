<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex cursor-pointer items-center rounded-full border-2 border-crust bg-white px-6 py-2.5 font-semibold hover:border-fern disabled:opacity-25']) }}>
    {{ $slot }}
</button>
