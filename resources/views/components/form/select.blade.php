@props(['name', 'label', 'options', 'value' => '', 'placeholder' => 'Choose...'])

<div class="space-y-1">
    <label for="{{ $name }}" class="block text-sm font-semibold">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}"
            class="block w-full rounded-md border {{ $errors->has($name) ? 'border-red-500' : 'border-gray-300' }}">
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $key => $text)
            <option value="{{ $key }}" @selected((string) old($name, $value) === (string) $key)>{{ $text }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
