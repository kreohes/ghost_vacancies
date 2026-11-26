<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-4xl font-bold">Hi {{ auth()->user()->name }}!</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4 grid gap-4 sm:grid-cols-3">
        <a href="{{ route('userzone.reports.index') }}" class="bg-white rounded-3xl p-6 hover:ring-2 hover:ring-lamp">
            <p class="text-3xl font-bold">{{ $reportCount }}</p>
            <p class="text-moss">reports you left</p>
        </a>
        <a href="{{ route('userzone.reports.index') }}" class="bg-white rounded-3xl p-6 hover:ring-2 hover:ring-lamp">
            <p class="text-3xl font-bold">{{ $waitingCount }}</p>
            <p class="text-moss">applications still in silence</p>
        </a>
        <a href="{{ route('userzone.vacancies.index') }}" class="bg-white rounded-3xl p-6 hover:ring-2 hover:ring-lamp">
            <p class="text-3xl font-bold">{{ $vacancyCount }}</p>
            <p class="text-moss">vacancies you added</p>
        </a>
    </div>
</x-app-layout>
