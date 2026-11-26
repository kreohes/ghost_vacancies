<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-4xl font-bold">Admin · Edit company</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8 px-4">
        <form action="{{ route('admin.companies.update', $company->id) }}" method="POST" class="bg-white rounded-3xl p-6 space-y-4">
            @csrf
            @method('PUT')

            <x-form.input name="name" label="Company name" :value="$company->name" />
            <x-form.input name="website" label="Website (optional)" type="url" :value="$company->website" />

            <button type="submit" class="rounded-full bg-dusk px-4 py-2 text-white hover:bg-fern">Save changes</button>
        </form>
    </div>
</x-app-layout>
