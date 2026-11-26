<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-4xl font-bold">{{ $company->name }}</h2>
        @if ($company->website)
            <a href="{{ $company->website }}" target="_blank" rel="noopener" class="text-fern underline text-sm">{{ $company->website }}</a>
        @endif
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4 space-y-6">
        <div class="bg-white rounded-3xl p-6">
            <p class="text-lg">
                "No answer" rate:
                @if ($company->noAnswerRate() === null)
                    <span class="text-moss">not enough data</span>
                @else
                    <strong>{{ round($company->noAnswerRate() * 100) }}%</strong>
                @endif
            </p>
            <p class="text-sm text-moss">Based on {{ $company->reports->count() }} reports over all vacancies of this company.</p>
        </div>

        <div>
            <h3 class="font-semibold text-lg mb-2">Vacancies</h3>
            <x-vacancy-cards :vacancies="$company->vacancies" :show-company="false" />
        </div>
    </div>
</x-app-layout>
