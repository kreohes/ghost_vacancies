<x-app-layout>
    <div class="mx-auto max-w-5xl space-y-4 px-4 py-8">
        <div class="px-1 pb-2">
            <h1 class="font-display text-4xl leading-none font-bold sm:text-5xl">{{ $company->name }}</h1>
            @if ($company->website)
                <a href="{{ $company->website }}" target="_blank" rel="noopener" class="mt-2 inline-block font-semibold text-fern underline underline-offset-2">{{ $company->website }}</a>
            @endif
        </div>

        <section class="flex flex-wrap items-center justify-between gap-x-6 gap-y-3 rounded-4xl bg-white p-6 sm:p-8">
            <div>
                <h2 class="font-display text-2xl font-semibold">"No answer" rate</h2>
                <p class="mt-1 text-moss">Based on {{ $company->reports->count() }} reports over all vacancies of this company.</p>
            </div>
            @if ($company->noAnswerRate() === null)
                <p class="flex items-center gap-2 font-display text-2xl font-semibold text-nodata">
                    <x-risk-ghosts label="not enough data" size="size-8" /> Not enough data
                </p>
            @else
                <p class="font-display text-5xl font-bold">{{ round($company->noAnswerRate() * 100) }}%</p>
            @endif
        </section>

        <h2 class="px-1 pt-6 font-display text-3xl font-bold">Vacancies</h2>
        <x-vacancy-cards :vacancies="$company->vacancies" :show-company="false" />
    </div>
</x-app-layout>
