<x-app-layout>
    <div class="mx-auto max-w-5xl space-y-4 px-4 py-8">
        <section class="flex flex-wrap items-center gap-x-6 gap-y-3 rounded-4xl bg-dusk p-6 text-white sm:p-8">
            <x-mascot class="h-20 w-18" />
            <div class="min-w-48 flex-1">
                <h1 class="font-display text-4xl font-bold">Hi {{ auth()->user()->name }}!</h1>
                <p class="mt-1 text-lg text-white/80">Thanks for helping other job seekers.</p>
            </div>
            <a href="{{ route('userzone.reports.create') }}" class="rounded-full bg-lamp px-5 py-2.5 font-semibold text-dusk hover:bg-white">Leave a report</a>
        </section>

        <div class="grid gap-4 sm:grid-cols-3">
            <a href="{{ route('userzone.reports.index') }}" class="rounded-3xl bg-white p-6 hover:ring-3 hover:ring-lamp">
                <p class="font-display text-5xl font-bold">{{ $reportCount }}</p>
                <p class="mt-1 text-moss">reports you left</p>
            </a>
            <a href="{{ route('userzone.reports.index') }}" class="rounded-3xl bg-silence-soft p-6 text-silence hover:ring-3 hover:ring-lamp">
                <p class="font-display text-5xl font-bold">{{ $waitingCount }}</p>
                <p class="mt-1">applications still in silence</p>
            </a>
            <a href="{{ route('userzone.vacancies.index') }}" class="rounded-3xl bg-white p-6 hover:ring-3 hover:ring-lamp">
                <p class="font-display text-5xl font-bold">{{ $vacancyCount }}</p>
                <p class="mt-1 text-moss">vacancies you added</p>
            </a>
        </div>
    </div>
</x-app-layout>
