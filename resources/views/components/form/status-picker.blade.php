@props(['value' => ''])

@php
    $explanations = [
        'silence' => 'No answer at all, not even a rejection',
        'replied' => 'They answered (also a rejection counts)',
        'interview' => 'You were invited to an interview',
    ];
@endphp

<fieldset class="space-y-2">
    <legend class="text-sm font-semibold">What happened after you applied?</legend>

    <div class="grid gap-2 sm:grid-cols-3">
        @foreach ($explanations as $status => $explanation)
            <label class="flex cursor-pointer flex-col rounded-lg border p-3 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                <span class="flex items-center gap-2">
                    <input type="radio" name="status" value="{{ $status }}" @checked(old('status', $value) === $status)>
                    <x-status-pill :status="$status" />
                </span>
                <span class="mt-1 text-xs text-gray-600">{{ $explanation }}</span>
            </label>
        @endforeach
    </div>

    @error('status')
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</fieldset>
