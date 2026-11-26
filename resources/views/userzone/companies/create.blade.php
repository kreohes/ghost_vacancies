<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h2 class="font-display text-4xl font-bold">Add a company</h2>
            <p class="text-moss">After saving you go straight back to adding your vacancy.</p>
        </div>

        <form action="{{ route('userzone.companies.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-6 space-y-4">
            @csrf

            <x-form.input name="name" label="Company name" />
            <x-form.input name="website" label="Website (optional)" type="url" />
            <x-form.file name="logo" label="Logo (optional)" hint="PNG, JPG or WebP, up to 2 MB. We make a small square version for the lists." />

            <button type="submit" class="rounded-full bg-dusk px-4 py-2 text-white hover:bg-fern">Add company</button>
        </form>
    </div>
</x-app-layout>
