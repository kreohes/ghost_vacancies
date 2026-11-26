@props(['vacancies', 'showCompany' => true])

@if ($vacancies->isEmpty() && $slot->isEmpty())
    <p class="text-moss">No vacancies yet.</p>
@else
    <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($vacancies as $vacancy)
            @php
                $band = match ($vacancy->riskLabel()) {
                    'high' => 'bg-high-soft text-high',
                    'medium' => 'bg-medium-soft text-medium',
                    'low' => 'bg-low-soft text-low',
                    default => 'bg-nodata-soft text-nodata',
                };
            @endphp
            <li class="flex flex-col overflow-hidden rounded-3xl bg-white">
                <p class="flex items-center justify-between gap-3 px-5 py-3 font-semibold {{ $band }}">
                    <span class="flex items-center gap-2">
                        <x-risk-ghosts :label="$vacancy->riskLabel()" />
                        {{ ucfirst($vacancy->riskLabel()) }}
                    </span>
                    @if ($vacancy->ghostRisk() !== null)
                        <span>{{ round($vacancy->ghostRisk() * 100) }}% silence</span>
                    @endif
                </p>
                <div class="flex grow flex-col p-5">
                    <a href="{{ route('vacancies.show', $vacancy) }}" class="font-display text-2xl leading-tight font-semibold hover:underline">{{ $vacancy->title }}</a>
                    @if ($showCompany)
                        <p class="mt-1 text-moss">at <a href="{{ route('companies.show', $vacancy->company) }}" class="underline decoration-crust decoration-2 underline-offset-4 hover:decoration-fern">{{ $vacancy->company->name }}</a></p>
                    @endif
                    @if (in_array($vacancy->scamLabel(), ['likely scam', 'suspicious']))
                        <p class="mt-3"><x-scam-badge :label="$vacancy->scamLabel()" /></p>
                    @endif
                    <p class="mt-auto flex justify-between gap-3 pt-4 text-sm text-moss">
                        <span>Posted {{ $vacancy->posted_at?->format('d.m.Y') ?? 'unknown' }}</span>
                        <span>{{ $vacancy->reports->count() }} reports</span>
                    </p>
                </div>
            </li>
        @endforeach

        {{ $slot }}
    </ul>
@endif
