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
