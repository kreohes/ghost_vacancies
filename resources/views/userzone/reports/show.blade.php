<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-4xl font-bold">Report on {{ $report->vacancy->title }}</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="bg-white rounded-3xl p-6">
            <dl class="grid grid-cols-3 gap-y-3 text-sm">
                <dt class="text-moss">Vacancy</dt>
                <dd class="col-span-2">
                    <a href="{{ route('vacancies.show', $report->vacancy) }}" class="text-fern hover:underline">{{ $report->vacancy->title }}</a>
                    at {{ $report->vacancy->company->name }}
                </dd>

                <dt class="text-moss">Status</dt>
                <dd class="col-span-2"><x-status-pill :status="$report->status" /></dd>

                <dt class="text-moss">Applied on</dt>
                <dd class="col-span-2">{{ $report->applied_at->format('d.m.Y') }} ({{ $report->applied_at->diffForHumans() }})</dd>

                <dt class="text-moss">Comment</dt>
                <dd class="col-span-2">{{ $report->comment ?? '-' }}</dd>

                <dt class="text-moss">Counts for risk</dt>
                <dd class="col-span-2">{{ $report->countsForRisk() ? 'yes' : 'not yet (silence younger than 14 days)' }}</dd>
            </dl>

            <div class="mt-6 flex gap-4 text-sm">
                <a href="{{ route('userzone.reports.edit', $report->id) }}" class="text-fern hover:underline">Update status</a>
                <a href="{{ route('userzone.reports.index') }}" class="text-moss hover:underline">Back to my reports</a>
            </div>
        </div>
    </div>
</x-app-layout>
