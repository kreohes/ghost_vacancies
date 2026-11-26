<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Report on {{ $report->vacancy->title }}</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="bg-white shadow-xs rounded-lg p-6">
            <dl class="grid grid-cols-3 gap-y-3 text-sm">
                <dt class="text-gray-500">Vacancy</dt>
                <dd class="col-span-2">
                    <a href="{{ route('vacancies.show', $report->vacancy) }}" class="text-indigo-600 hover:underline">{{ $report->vacancy->title }}</a>
                    at {{ $report->vacancy->company->name }}
                </dd>

                <dt class="text-gray-500">Status</dt>
                <dd class="col-span-2"><x-status-pill :status="$report->status" /></dd>

                <dt class="text-gray-500">Applied on</dt>
                <dd class="col-span-2">{{ $report->applied_at->format('d.m.Y') }} ({{ $report->applied_at->diffForHumans() }})</dd>

                <dt class="text-gray-500">Comment</dt>
                <dd class="col-span-2">{{ $report->comment ?? '-' }}</dd>

                <dt class="text-gray-500">Counts for risk</dt>
                <dd class="col-span-2">{{ $report->countsForRisk() ? 'yes' : 'not yet (silence younger than 14 days)' }}</dd>
            </dl>

            <div class="mt-6 flex gap-4 text-sm">
                <a href="{{ route('userzone.reports.edit', $report->id) }}" class="text-indigo-600 hover:underline">Update status</a>
                <a href="{{ route('userzone.reports.index') }}" class="text-gray-600 hover:underline">Back to my reports</a>
            </div>
        </div>
    </div>
</x-app-layout>
