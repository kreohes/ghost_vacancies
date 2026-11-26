<x-app-layout>
    @php
        $label = $vacancy->riskLabel();
        $riskColors = match ($label) {
            'high' => 'bg-high-soft text-high',
            'medium' => 'bg-medium-soft text-medium',
            'low' => 'bg-low-soft text-low',
            default => 'bg-nodata-soft text-nodata',
        };
        $counted = $vacancy->countedReports();
    @endphp

    <div class="mx-auto max-w-3xl space-y-4 px-4 py-8 md:py-12">
        @if (session('status'))
            <p class="rounded-3xl bg-white px-5 py-3 font-semibold text-fern">{{ session('status') }}</p>
        @endif

        <div class="px-1 pb-2">
            <h1 class="font-display text-4xl leading-none font-bold sm:text-5xl">{{ $vacancy->title }}</h1>
            <p class="mt-3 flex items-center gap-3 text-xl text-moss">
                <x-company-logo :company="$vacancy->company" size="size-10" class="text-lg" />
                <span>at <a href="{{ route('companies.show', $vacancy->company) }}" class="font-semibold text-fern underline decoration-2 underline-offset-4">{{ $vacancy->company->name }}</a></span>
            </p>
            <dl class="mt-4 flex flex-wrap gap-x-8 gap-y-2">
                <div class="flex gap-2"><dt class="text-moss">Posted</dt><dd class="font-medium">{{ $vacancy->posted_at?->format('d.m.Y') ?? 'unknown' }}</dd></div>
                <div class="flex gap-2"><dt class="text-moss">Added by</dt><dd class="font-medium">{{ $vacancy->user->name }}</dd></div>
                @if ($vacancy->url)
                    <div><dt class="sr-only">Source</dt><dd><a href="{{ $vacancy->url }}" target="_blank" rel="noopener" class="font-semibold text-fern underline underline-offset-2">Original posting</a></dd></div>
                @endif
            </dl>
        </div>

        <section class="rounded-4xl p-6 sm:p-8 {{ $riskColors }}">
            <div class="flex flex-wrap items-center justify-between gap-x-6 gap-y-3">
                <p class="flex items-center gap-2 font-display text-2xl font-semibold">
                    <x-risk-ghosts :label="$label" size="size-9" />
                    {{ ucfirst($label) }}{{ $vacancy->ghostRisk() !== null ? ' risk' : '' }}
                </p>
                @if ($vacancy->ghostRisk() !== null)
                    <p class="font-display text-4xl font-bold sm:text-5xl">{{ round($vacancy->ghostRisk() * 100) }}% silence</p>
                @endif
            </div>

            @if ($vacancy->reports->isNotEmpty())
                <ul class="mt-6 flex flex-wrap gap-1.5 sm:gap-2">
                    @foreach ($vacancy->reports->sortByDesc('applied_at') as $report)
                        <li title="{{ $report->status }}{{ $report->countsForRisk() ? '' : ', not counted yet' }}" @class([
                            'grid size-10 place-items-center rounded-full',
                            'bg-silence text-white' => $report->status === 'silence',
                            'bg-white text-replied' => $report->status === 'replied',
                            'bg-white text-interview' => $report->status === 'interview',
                            'opacity-40' => ! $report->countsForRisk(),
                        ])>
                            <svg class="size-5" aria-hidden="true"><use href="#{{ $report->status }}"/></svg>
                        </li>
                    @endforeach
                </ul>
            @endif

            <p class="mt-4 text-lg leading-relaxed text-dusk">
                @if ($vacancy->ghostRisk() !== null)
                    {{ $counted->where('status', 'silence')->count() }} of the {{ $counted->count() }} counted reports never got an answer.
                    @if ($label === 'high')
                        If that happened to you too, it says more about this vacancy than about you.
                    @endif
                @else
                    Not enough reports yet. A vacancy needs 3 counted reports, and a silence only counts once the application is 14 days old.
                @endif
            </p>
            <a href="{{ route('risk') }}" class="mt-2 inline-block font-semibold underline underline-offset-2">How is this calculated?</a>
        </section>

        <section class="flex flex-wrap items-center gap-x-5 gap-y-3 rounded-4xl bg-lamp p-5 sm:px-8">
            <x-mascot class="h-16 w-15" />
            @guest
                <p class="min-w-48 flex-1 text-lg">Applied here? Log in to tell others what happened.</p>
                <a href="{{ route('login') }}" class="rounded-full bg-dusk px-5 py-2.5 font-semibold text-white hover:bg-fern">Log in</a>
            @else
                @if ($myReport)
                    <p class="min-w-48 flex-1 text-lg leading-loose">
                        You reported <x-status-pill :status="$myReport->status" /> on {{ $myReport->applied_at->format('d.m.Y') }}.
                    </p>
                    <a href="{{ route('userzone.reports.edit', $myReport->id) }}" class="rounded-full bg-dusk px-5 py-2.5 font-semibold text-white hover:bg-fern">Update status</a>
                @else
                    <p class="min-w-48 flex-1 text-lg">Applied here? It takes a minute and helps the next person.</p>
                    <a href="{{ route('userzone.reports.create', ['vacancy_id' => $vacancy->id]) }}" class="rounded-full bg-dusk px-5 py-2.5 font-semibold text-white hover:bg-fern">Leave a report</a>
                @endif
            @endguest
        </section>

        @if ($vacancy->description)
            <section class="rounded-4xl bg-white p-6 sm:p-8">
                <h2 class="font-display text-2xl font-semibold">Text of the posting</h2>
                <p class="mt-3 text-lg leading-relaxed whitespace-pre-line">{{ $vacancy->description }}</p>
            </section>

            <section class="rounded-4xl bg-white p-6 sm:p-8">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h2 class="font-display text-2xl font-semibold">Scam signal</h2>
                        <p class="mt-1"><x-scam-badge :label="$vacancy->scamLabel()" /></p>
                    </div>
                    <p class="font-display text-4xl font-bold">{{ round($vacancy->scamProbability() * 100) }}%</p>
                </div>
                <div class="mt-3 h-4 rounded-full bg-butter">
                    <div class="h-4 rounded-full bg-dusk" style="width: {{ round($vacancy->scamProbability() * 100) }}%"></div>
                </div>
                @if ($vacancy->scamProbability() >= 0.5 && $vacancy->scamWords())
                    <p class="mt-5 flex flex-wrap items-center gap-2">
                        <span class="mr-1">Words that raise it most:</span>
                        @foreach ($vacancy->scamWords() as $word)
                            <span class="rounded-full bg-peach px-3.5 py-1 font-semibold">{{ $word }}</span>
                        @endforeach
                    </p>
                @endif
                <p class="mt-4 text-sm leading-relaxed text-moss">
                    Separate from the ghost risk. A simple model trained on old fraudulent job ads (2012-2014) computes it from the text alone, so it can be wrong.
                    <a href="{{ route('risk') }}#scam-signal" class="font-semibold text-fern underline underline-offset-2">How is this calculated?</a>
                </p>
            </section>
        @endif

        <h2 class="px-1 pt-6 font-display text-3xl font-bold">Reports ({{ $vacancy->reports->count() }})</h2>
        <ul class="space-y-3">
            @forelse ($vacancy->reports->sortByDesc('applied_at') as $report)
                <li @class(['flex gap-4 rounded-3xl bg-white p-5', 'ring-3 ring-lamp' => $myReport && $report->id === $myReport->id])>
                    <span @class([
                        'grid size-11 shrink-0 place-items-center rounded-full',
                        'bg-silence-soft text-silence' => $report->status === 'silence',
                        'bg-replied-soft text-replied' => $report->status === 'replied',
                        'bg-interview-soft text-interview' => $report->status === 'interview',
                    ])>
                        <svg class="size-5" aria-hidden="true"><use href="#{{ $report->status }}"/></svg>
                    </span>
                    <div>
                        <p class="flex flex-wrap items-baseline gap-x-3">
                            <strong class="font-display text-lg font-semibold">{{ $report->status }}</strong>
                            <span class="text-sm text-moss">applied on {{ $report->applied_at->format('d.m.Y') }}</span>
                            @if ($myReport && $report->id === $myReport->id)
                                <span class="text-sm font-semibold">your report</span>
                            @endif
                        </p>
                        <p class="mt-1 leading-relaxed {{ $report->comment ? '' : 'text-moss' }}">{{ $report->comment ?? 'No comment.' }}</p>
                    </div>
                </li>
            @empty
                <li class="rounded-3xl bg-white p-5 text-moss">No reports yet. Be the first to tell what happened.</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
