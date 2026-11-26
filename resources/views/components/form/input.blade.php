@props(['name', 'label', 'value' => '', 'type' => 'text', 'required' => false])

<div>
    <label for="{{ $name }}" class="block font-display text-lg font-semibold">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" @required($required)
           @class([
               'mt-2 block w-full rounded-2xl border-2 px-4 py-3 focus:outline-2 focus:outline-offset-2',
               'border-high bg-high-soft/50 focus:outline-high' => $errors->has($name),
               'border-crust bg-white hover:border-fern focus:border-fern focus:outline-fern' => ! $errors->has($name),
           ])>
    @error($name)
        <p class="mt-2 inline-block rounded-2xl bg-high-soft px-4 py-2 text-sm font-semibold text-high">{{ $message }}</p>
    @enderror
</div>
