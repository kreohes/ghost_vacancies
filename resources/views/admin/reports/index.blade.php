<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Admin · Reports moderation</h2>
        <p class="text-gray-600">All {{ $reports->count() }} reports, newest first. Delete fake or spam reports.</p>
    </x-slot>

    <div class="max-w-6xl mx-auto py-8 px-4">
        <x-admin-tabs />

        <table class="w-full bg-white shadow-xs rounded-lg text-sm">
            <thead class="text-left text-gray-500 border-b">
                <tr>
                    <th class="p-3">Added</th>
                    <th class="p-3">By</th>
                    <th class="p-3">Vacancy</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Comment</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr class="border-b last:border-0 align-top">
                        <td class="p-3 whitespace-nowrap text-gray-500">{{ $report->created_at->format('d.m.Y H:i') }}</td>
                        <td class="p-3">{{ $report->user->name }}<br><span class="text-gray-500">{{ $report->user->email }}</span></td>
                        <td class="p-3">
                            <a href="{{ route('vacancies.show', $report->vacancy) }}" class="text-indigo-600 hover:underline">{{ $report->vacancy->title }}</a>
                            <br><span class="text-gray-500">{{ $report->vacancy->company->name }}</span>
                        </td>
                        <td class="p-3"><x-status-pill :status="$report->status" /></td>
                        <td class="p-3 text-gray-700">{{ $report->comment }}</td>
                        <td class="p-3 text-right">
                            <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Delete this report?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
