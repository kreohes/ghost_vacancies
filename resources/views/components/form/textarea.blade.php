@props(['name', 'label', 'value' => ''])

<div>
    <label for="{{ $name }}" class="block font-display text-lg font-semibold">{{ $label }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}" rows="4"
              @class([
                  'mt-2 block w-full rounded-2xl border-2 px-4 py-3 leading-relaxed focus:outline-2 focus:outline-offset-2',
                  'border-high bg-high-soft/50 focus:outline-high' => $errors->has($name),
                  'border-crust bg-white hover:border-fern focus:border-fern focus:outline-fern' => ! $errors->has($name),
              ])>{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="mt-2 inline-block rounded-2xl bg-high-soft px-4 py-2 text-sm font-semibold text-high">{{ $message }}</p>
    @enderror
</div>
