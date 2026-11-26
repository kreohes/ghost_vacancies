<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add a company</h2>
        <p class="text-gray-600">After saving you go straight back to adding your vacancy.</p>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8 px-4">
        <form action="{{ route('userzone.companies.store') }}" method="POST" class="bg-white shadow-xs rounded-lg p-6 space-y-4">
            @csrf

            <x-form.input name="name" label="Company name" />
            <x-form.input name="website" label="Website (optional)" type="url" />

            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Add company</button>
        </form>
    </div>
</x-app-layout>
