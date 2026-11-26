<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">{{ $vacancy->title }}</h2>
        <p class="text-gray-600">
            at <a href="{{ route('companies.show', $vacancy->company) }}" class="text-indigo-600 hover:underline">{{ $vacancy->company->name }}</a>
        </p>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 space-y-6">
        <div class="bg-white shadow-xs rounded-lg p-6 space-y-2">
            <p>
                Ghost risk: <x-risk-badge :label="$vacancy->riskLabel()" />
                @if ($vacancy->ghostRisk() !== null)
                    <span class="text-gray-500">({{ round($vacancy->ghostRisk() * 100) }}% silence)</span>
                @endif
                <a href="{{ route('risk') }}" class="text-sm text-gray-500 underline ms-2">how is this calculated?</a>
            </p>
            <p class="text-gray-600">Posted: {{ $vacancy->posted_at?->format('d.m.Y') ?? 'unknown' }}</p>
            @if ($vacancy->url)
                <p><a href="{{ $vacancy->url }}" target="_blank" rel="noopener" class="text-indigo-600 underline">Original posting</a></p>
            @endif
            <p class="text-sm text-gray-500">Added by {{ $vacancy->user->name }}</p>
        </div>

        @if ($vacancy->description)
            <div class="bg-white shadow-xs rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-2">Text of the posting</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $vacancy->description }}</p>
            </div>
        @endif

        <div class="rounded-lg border border-indigo-200 bg-indigo-50 p-4">
            @guest
                <a href="{{ route('login') }}" class="text-indigo-700 underline">Log in</a> to report what happened after you applied here.
            @else
                @if ($myReport)
                    You reported <x-status-pill :status="$myReport->status" /> on {{ $myReport->applied_at->format('d.m.Y') }}.
                    <a href="{{ route('userzone.reports.edit', $myReport->id) }}" class="text-indigo-700 underline ms-2">Update status</a>
                @else
                    Applied here?
                    <a href="{{ route('userzone.reports.create', ['vacancy_id' => $vacancy->id]) }}" class="ms-2 rounded-md bg-indigo-600 px-3 py-1 text-white hover:bg-indigo-700">Leave a report</a>
                @endif
            @endguest
        </div>

        <div>
            <h3 class="font-semibold text-lg mb-2">Reports ({{ $vacancy->reports->count() }})</h3>

            @forelse ($vacancy->reports->sortByDesc('applied_at') as $report)
                <div class="bg-white shadow-xs rounded-lg p-4 mb-2">
                    <p>
                        <x-status-pill :status="$report->status" />
                        <span class="text-gray-500 text-sm">applied on {{ $report->applied_at->format('d.m.Y') }}</span>
                    </p>
                    @if ($report->comment)
                        <p class="text-gray-700 mt-1">{{ $report->comment }}</p>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">No reports yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
