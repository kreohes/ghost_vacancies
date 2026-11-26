<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h2 class="font-display text-4xl font-bold">Add a vacancy</h2>
        </div>

        <form action="{{ route('userzone.vacancies.store') }}" method="POST" class="bg-white rounded-3xl p-6 space-y-4">
            @csrf

            <x-form.input name="title" label="Job title" />
            <x-form.select name="company_id" label="Company" :options="$companies" :value="$selectedCompanyId" placeholder="Choose a company" />
            <p class="text-sm text-moss">
                Company not in the list? <a href="{{ route('userzone.companies.create') }}" class="text-fern underline">Add it first</a>.
            </p>
            <x-form.textarea name="description" label="Text of the posting (optional)" />
            <x-form.input name="url" label="Link to the original posting (optional)" type="url" :value="$url" />
            <x-form.input name="posted_at" label="Posted on (optional)" type="date" />

            <button type="submit" class="rounded-full bg-dusk px-4 py-2 text-white hover:bg-fern">Add vacancy</button>
        </form>
    </div>
</x-app-layout>
