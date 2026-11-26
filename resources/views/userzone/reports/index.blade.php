<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">My reports</h2>
            <a href="{{ route('userzone.reports.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-700">+ Leave a report</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 space-y-3">
        @forelse ($reports as $report)
            <div class="bg-white shadow-xs rounded-lg p-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <a href="{{ route('vacancies.show', $report->vacancy) }}" class="font-semibold text-gray-900 hover:underline">{{ $report->vacancy->title }}</a>
                        <p class="text-sm text-gray-500">{{ $report->vacancy->company->name }} · applied on {{ $report->applied_at->format('d.m.Y') }}</p>
                    </div>
                    <x-status-pill :status="$report->status" />
                </div>

                @if ($report->comment)
                    <p class="mt-2 text-sm text-gray-700">{{ $report->comment }}</p>
                @endif

                <div class="mt-3 flex items-center gap-4 text-sm">
                    <a href="{{ route('userzone.reports.show', $report->id) }}" class="text-gray-600 hover:underline">Details</a>
                    <a href="{{ route('userzone.reports.edit', $report->id) }}" class="text-indigo-600 hover:underline">Update status</a>
                    <form action="{{ route('userzone.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Delete this report?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white shadow-xs rounded-lg p-8 text-center text-gray-500">
                You have not reported any applications yet.
            </div>
        @endforelse
    </div>
</x-app-layout>
