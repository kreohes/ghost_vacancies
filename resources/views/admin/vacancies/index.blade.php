<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-4xl font-bold">Admin · Vacancies</h2>
        <p class="text-moss">Fix the wrong company, merge duplicates by deleting one, remove spam.</p>
    </x-slot>

    <div class="max-w-6xl mx-auto py-8 px-4">
        <x-admin-tabs />

        <table class="w-full bg-white rounded-3xl text-sm">
            <thead class="text-left text-moss border-b">
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
                        <td class="p-3"><a href="{{ route('vacancies.show', $vacancy) }}" class="text-fern hover:underline">{{ $vacancy->title }}</a></td>
                        <td class="p-3">{{ $vacancy->company->name }}</td>
                        <td class="p-3">{{ $vacancy->user->name }}</td>
                        <td class="p-3">{{ $vacancy->reports_count }}</td>
                        <td class="p-3">
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.vacancies.edit', $vacancy->id) }}" class="text-fern hover:underline">Edit</a>
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
