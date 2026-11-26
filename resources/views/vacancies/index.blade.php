<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Vacancies</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4">
        <x-vacancy-cards :vacancies="$vacancies" />
    </div>
</x-app-layout>
