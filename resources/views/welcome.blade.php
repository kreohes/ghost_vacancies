<x-app-layout>
    <div class="bg-white border-b">
        <div class="max-w-5xl mx-auto py-12 px-4">
            <h1 class="text-3xl font-bold text-gray-900">Is anybody actually hiring?</h1>
            <p class="mt-3 text-lg text-gray-600 max-w-2xl">
                Ghost Vacancies collects what happened after people applied: silence, a reply or an interview.
                From these reports every vacancy gets a ghost-risk label and every company a "no answer" rate.
            </p>
            <div class="mt-6 flex gap-3">
                <a href="{{ route('vacancies.index') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Browse vacancies</a>
                <a href="{{ route('companies.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">Browse companies</a>
            </div>
            <p class="mt-6 text-sm text-gray-500">
                {{ $vacancyCount }} vacancies, {{ $companyCount }} companies, {{ $reportCount }} reports so far.
            </p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto py-8 px-4">
        <h2 class="font-semibold text-xl text-gray-800 mb-3">Latest high-risk vacancies</h2>
        <x-vacancy-table :vacancies="$highRiskVacancies" />
    </div>
</x-app-layout>
