<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Admin · Companies</h2>
        <p class="text-gray-600">Deleting a company also deletes its vacancies and their reports.</p>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4">
        <x-admin-tabs />

        <table class="w-full bg-white shadow-xs rounded-lg text-sm">
            <thead class="text-left text-gray-500 border-b">
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
                        <td class="p-3"><a href="{{ route('companies.show', $company) }}" class="text-indigo-600 hover:underline">{{ $company->name }}</a></td>
                        <td class="p-3 text-gray-500">{{ $company->website ?? '-' }}</td>
                        <td class="p-3">{{ $company->vacancies_count }}</td>
                        <td class="p-3">
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.companies.edit', $company->id) }}" class="text-indigo-600 hover:underline">Edit</a>
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
