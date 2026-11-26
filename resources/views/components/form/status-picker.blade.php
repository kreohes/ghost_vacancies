@props(['value' => ''])

@php
    $explanations = [
        'silence' => 'No answer at all, not even a rejection',
        'replied' => 'They answered (a rejection counts too)',
        'interview' => 'You were invited to an interview',
    ];
    $iconColors = [
        'silence' => 'bg-silence-soft text-silence',
        'replied' => 'bg-replied-soft text-replied',
        'interview' => 'bg-interview-soft text-interview',
    ];
@endphp

<fieldset>
    <legend class="font-display text-lg font-semibold">What happened after you applied?</legend>

    <div class="mt-2 grid gap-3 sm:grid-cols-3">
        @foreach ($explanations as $status => $explanation)
            <label class="flex cursor-pointer items-center gap-3 rounded-3xl border-2 border-crust p-4 hover:border-fern has-[:checked]:border-dusk has-[:checked]:bg-butter has-[:focus-visible]:outline-2 has-[:focus-visible]:outline-offset-2 has-[:focus-visible]:outline-fern sm:flex-col sm:items-start">
                <input type="radio" name="status" value="{{ $status }}" class="sr-only" @checked(old('status', $value) === $status)>
                <span class="grid size-12 shrink-0 place-items-center rounded-full {{ $iconColors[$status] }}">
                    <svg class="size-6" aria-hidden="true"><use href="#{{ $status }}"/></svg>
                </span>
                <span>
                    <strong class="block font-display text-lg font-semibold">{{ ucfirst($status) }}</strong>
                    <span class="block text-sm leading-snug text-moss">{{ $explanation }}</span>
                </span>
            </label>
        @endforeach
    </div>

    @error('status')
        <p class="mt-2 inline-block rounded-2xl bg-high-soft px-4 py-2 text-sm font-semibold text-high">{{ $message }}</p>
    @enderror
</fieldset>
