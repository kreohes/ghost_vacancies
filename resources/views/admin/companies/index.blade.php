<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h2 class="font-display text-4xl font-bold">Admin · Companies</h2>
            <p class="text-moss">Deleting a company also deletes its vacancies and their reports.</p>
        </div>

        <x-admin-tabs />

        <table class="w-full bg-white rounded-3xl text-sm">
            <thead class="text-left text-moss border-b">
                <tr>
                    <th class="p-3">Company</th>
                    <th class="p-3">Website</th>
                    <th class="p-3">Vacancies</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr class="border-b last:border-0">
                        <td class="p-3"><a href="{{ route('companies.show', $company) }}" class="text-fern hover:underline">{{ $company->name }}</a></td>
                        <td class="p-3 text-moss">{{ $company->website ?? '-' }}</td>
                        <td class="p-3">{{ $company->vacancies_count }}</td>
                        <td class="p-3">
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.companies.edit', $company->id) }}" class="text-fern hover:underline">Edit</a>
                                <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Delete {{ $company->name }} with {{ $company->vacancies_count }} vacancies?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
