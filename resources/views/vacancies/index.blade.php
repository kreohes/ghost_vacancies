<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h2 class="font-display text-4xl font-bold">Vacancies</h2>
        </div>

        <x-vacancy-cards :vacancies="$vacancies" />
    </div>
</x-app-layout>
