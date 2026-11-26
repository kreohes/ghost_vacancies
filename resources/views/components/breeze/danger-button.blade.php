<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex cursor-pointer items-center rounded-full bg-high px-6 py-2.5 font-semibold text-white hover:bg-high/85']) }}>
    {{ $slot }}
</button>
