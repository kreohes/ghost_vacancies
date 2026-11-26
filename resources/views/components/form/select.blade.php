@props(['name', 'label', 'options', 'value' => '', 'placeholder' => 'Choose...'])

<div>
    <label for="{{ $name }}" class="block font-display text-lg font-semibold">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}"
            @class([
                'mt-2 block w-full rounded-2xl border-2 px-4 py-3 focus:outline-2 focus:outline-offset-2',
                'border-high bg-high-soft/50 focus:outline-high' => $errors->has($name),
                'border-crust bg-white hover:border-fern focus:border-fern focus:outline-fern' => ! $errors->has($name),
            ])>
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $key => $text)
            <option value="{{ $key }}" @selected((string) old($name, $value) === (string) $key)>{{ $text }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="mt-2 inline-block rounded-2xl bg-high-soft px-4 py-2 text-sm font-semibold text-high">{{ $message }}</p>
    @enderror
</div>
