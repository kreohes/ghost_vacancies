@props(['name', 'label', 'value' => ''])

<div class="space-y-1">
    <label for="{{ $name }}" class="block text-sm font-semibold">{{ $label }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}" rows="4"
              class="block w-full rounded-md border {{ $errors->has($name) ? 'border-red-500' : 'border-gray-300' }}">{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
