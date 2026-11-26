<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">My reports</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="mb-4">
            <a href="{{ route('userzone.reports.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Leave a report</a>
        </div>

        <table class="w-full bg-white shadow-xs rounded-lg text-sm">
            <thead class="text-left text-gray-500 border-b">
                <tr>
                    <th class="p-3">Vacancy</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Applied</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                    <tr class="border-b last:border-0">
                        <td class="p-3">{{ $report->vacancy->title }} <span class="text-gray-500">at {{ $report->vacancy->company->name }}</span></td>
                        <td class="p-3">{{ $report->status }}</td>
                        <td class="p-3">{{ $report->applied_at->format('d.m.Y') }}</td>
                        <td class="p-3">
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('userzone.reports.show', $report->id) }}" class="text-gray-600 hover:underline">View</a>
                                <a href="{{ route('userzone.reports.edit', $report->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('userzone.reports.destroy', $report->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">You have not reported any applications yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
