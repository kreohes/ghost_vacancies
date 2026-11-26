<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Leave a report</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8 px-4">
        <form action="{{ route('userzone.reports.store') }}" method="POST" class="bg-white shadow-xs rounded-lg p-6 space-y-4">
            @csrf

            <x-form.select name="vacancy_id" label="Vacancy" :options="$vacancies" :value="$selectedVacancyId" placeholder="Choose a vacancy" />
            <p class="text-sm text-gray-500">
                Vacancy not in the list? <a href="{{ route('userzone.vacancies.create') }}" class="text-indigo-600 underline">Add it first</a>.
            </p>

            <x-form.status-picker />
            <x-form.input name="applied_at" label="Applied on" type="date" />
            <x-form.textarea name="comment" label="Comment (optional)" />

            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Save report</button>
        </form>
    </div>
</x-app-layout>
