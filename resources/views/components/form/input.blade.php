@props(['name', 'label', 'value' => '', 'type' => 'text', 'required' => false])

<div class="space-y-1">
    <label for="{{ $name }}" class="block text-sm font-semibold">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" @required($required)
           class="block w-full rounded-md border {{ $errors->has($name) ? 'border-red-500' : 'border-gray-300' }}">
    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
