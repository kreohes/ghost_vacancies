<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Hi {{ auth()->user()->name }}!</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4 grid gap-4 sm:grid-cols-3">
        <a href="{{ route('userzone.reports.index') }}" class="bg-white shadow-xs rounded-lg p-6 hover:ring-2 hover:ring-indigo-200">
            <p class="text-3xl font-bold">{{ $reportCount }}</p>
            <p class="text-gray-600">reports you left</p>
        </a>
        <a href="{{ route('userzone.reports.index') }}" class="bg-white shadow-xs rounded-lg p-6 hover:ring-2 hover:ring-indigo-200">
            <p class="text-3xl font-bold">{{ $waitingCount }}</p>
            <p class="text-gray-600">applications still in silence</p>
        </a>
        <a href="{{ route('userzone.vacancies.index') }}" class="bg-white shadow-xs rounded-lg p-6 hover:ring-2 hover:ring-indigo-200">
            <p class="text-3xl font-bold">{{ $vacancyCount }}</p>
            <p class="text-gray-600">vacancies you added</p>
        </a>
    </div>
</x-app-layout>
