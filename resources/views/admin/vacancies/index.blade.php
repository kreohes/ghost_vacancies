<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Admin · Vacancies</h2>
        <p class="text-gray-600">Fix the wrong company, merge duplicates by deleting one, remove spam.</p>
    </x-slot>

    <div class="max-w-6xl mx-auto py-8 px-4">
        <x-admin-tabs />

        <table class="w-full bg-white shadow-xs rounded-lg text-sm">
            <thead class="text-left text-gray-500 border-b">
                <tr>
                    <th class="p-3">Vacancy</th>
                    <th class="p-3">Company</th>
                    <th class="p-3">Added by</th>
                    <th class="p-3">Reports</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vacancies as $vacancy)
                    <tr class="border-b last:border-0">
                        <td class="p-3"><a href="{{ route('vacancies.show', $vacancy) }}" class="text-indigo-600 hover:underline">{{ $vacancy->title }}</a></td>
                        <td class="p-3">{{ $vacancy->company->name }}</td>
                        <td class="p-3">{{ $vacancy->user->name }}</td>
                        <td class="p-3">{{ $vacancy->reports_count }}</td>
                        <td class="p-3">
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.vacancies.edit', $vacancy->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.vacancies.destroy', $vacancy->id) }}" method="POST" onsubmit="return confirm('Delete this vacancy and all its reports?')">
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
