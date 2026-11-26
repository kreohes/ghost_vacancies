<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">About Ghost Vacancies</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 space-y-4 text-gray-700">
        <p>
            A ghost vacancy is a job posting where nobody is actually being hired. Companies keep old
            postings online to look like they are growing, to collect CVs for later, or simply because
            nobody removed them. Job seekers spend hours on applications that never get an answer.
        </p>
        <p>
            Ghost Vacancies collects what really happened after people applied. Every registered job seeker
            can add a vacancy and leave one report per vacancy: <strong>silence</strong>, <strong>replied</strong>
            or <strong>interview</strong>. When the situation changes (for example silence turns into an
            interview), you simply edit your report.
        </p>
        <p>
            From these reports the app calculates a ghost-risk label for every vacancy and a
            "no answer" rate for every company.
            <a href="{{ route('risk') }}" class="text-indigo-600 underline">Read how the risk is calculated.</a>
        </p>
    </div>
</x-app-layout>
