<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add a vacancy</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8 px-4">
        <form action="{{ route('userzone.vacancies.store') }}" method="POST" class="bg-white shadow-xs rounded-lg p-6 space-y-4">
            @csrf

            <x-form.input name="title" label="Job title" />
            <x-form.select name="company_id" label="Company" :options="$companies" :value="$selectedCompanyId" placeholder="Choose a company" />
            <x-form.input name="url" label="Link to the original posting (optional)" type="url" />
            <x-form.input name="posted_at" label="Posted on (optional)" type="date" />

            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Add vacancy</button>
        </form>
    </div>
</x-app-layout>
