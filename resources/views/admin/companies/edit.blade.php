<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h2 class="font-display text-4xl font-bold">Admin · Edit company</h2>
        </div>

        <form action="{{ route('admin.companies.update', $company->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-6 space-y-4">
            @csrf
            @method('PUT')

            <x-form.input name="name" label="Company name" :value="$company->name" />
            <x-form.input name="website" label="Website (optional)" type="url" :value="$company->website" />
            @if ($company->logoUrl())
                <img src="{{ $company->logoUrl() }}" alt="Current logo of {{ $company->name }}" class="size-20 rounded-2xl">
            @endif
            <x-form.file name="logo" label="New logo (optional)" hint="Uploading a new logo replaces the old one." />

            <button type="submit" class="rounded-full bg-dusk px-4 py-2 text-white hover:bg-fern">Save changes</button>
        </form>
    </div>
</x-app-layout>
