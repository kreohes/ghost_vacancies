<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex cursor-pointer items-center rounded-full bg-dusk px-6 py-2.5 font-semibold text-white hover:bg-fern focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-fern']) }}>
    {{ $slot }}
</button>
