<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-4xl font-bold">My reports</h2>
            <a href="{{ route('userzone.reports.create') }}" class="rounded-full bg-dusk px-4 py-2 text-sm text-white hover:bg-fern">+ Leave a report</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 space-y-3">
        @forelse ($reports as $report)
            <div class="bg-white rounded-3xl p-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <a href="{{ route('vacancies.show', $report->vacancy) }}" class="font-semibold text-dusk hover:underline">{{ $report->vacancy->title }}</a>
                        <p class="text-sm text-moss">{{ $report->vacancy->company->name }} · applied on {{ $report->applied_at->format('d.m.Y') }}</p>
                    </div>
                    <x-status-pill :status="$report->status" />
                </div>

                @if ($report->comment)
                    <p class="mt-2 text-sm text-dusk">{{ $report->comment }}</p>
                @endif

                <div class="mt-3 flex items-center gap-4 text-sm">
                    <a href="{{ route('userzone.reports.show', $report->id) }}" class="text-moss hover:underline">Details</a>
                    <a href="{{ route('userzone.reports.edit', $report->id) }}" class="text-fern hover:underline">Update status</a>
                    <form action="{{ route('userzone.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Delete this report?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl p-8 text-center text-moss">
                You have not reported any applications yet.
            </div>
        @endforelse
    </div>
</x-app-layout>
