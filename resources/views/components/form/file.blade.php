@props(['name', 'label', 'hint' => ''])

<div>
    <label for="{{ $name }}" class="block font-display text-lg font-semibold">{{ $label }}</label>
    <input type="file" id="{{ $name }}" name="{{ $name }}" accept="image/png, image/jpeg, image/webp"
           class="mt-2 block w-full rounded-2xl border-2 border-dashed border-crust bg-white px-4 py-3 file:mr-4 file:rounded-full file:border-0 file:bg-dusk file:px-4 file:py-2 file:font-semibold file:text-white hover:border-fern">
    @if ($hint)
        <p class="mt-2 text-sm text-moss">{{ $hint }}</p>
    @endif
    @error($name)
        <p class="mt-2 inline-block rounded-2xl bg-high-soft px-4 py-2 text-sm font-semibold text-high">{{ $message }}</p>
    @enderror
</div>
