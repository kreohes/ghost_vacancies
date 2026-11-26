<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h2 class="font-display text-4xl font-bold">Admin · Edit vacancy</h2>
            <p class="text-moss">Added by {{ $vacancy->user->name }}</p>
        </div>

        <form action="{{ route('admin.vacancies.update', $vacancy->id) }}" method="POST" class="bg-white rounded-3xl p-6 space-y-4">
            @csrf
            @method('PUT')

            <x-form.input name="title" label="Job title" :value="$vacancy->title" />
            <x-form.select name="company_id" label="Company" :options="$companies" :value="$vacancy->company_id" />
            <x-form.textarea name="description" label="Text of the posting (optional)" :value="$vacancy->description" />
            <x-form.input name="url" label="Link to the original posting (optional)" type="url" :value="$vacancy->url" />
            <x-form.input name="posted_at" label="Posted on (optional)" type="date" :value="$vacancy->posted_at?->format('Y-m-d')" />

            <button type="submit" class="rounded-full bg-dusk px-4 py-2 text-white hover:bg-fern">Save changes</button>
        </form>
    </div>
</x-app-layout>
