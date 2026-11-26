@props(['vacancies', 'showCompany' => true])

@if ($vacancies->isEmpty())
    <p class="text-gray-500">No vacancies yet.</p>
@else
    <table class="w-full bg-white shadow-xs rounded-lg text-sm">
        <thead class="text-left text-gray-500 border-b">
            <tr>
                <th class="p-3">Vacancy</th>
                @if ($showCompany)
                    <th class="p-3">Company</th>
                @endif
                <th class="p-3">Posted</th>
                <th class="p-3">Reports</th>
                <th class="p-3">Ghost risk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vacancies as $vacancy)
                <tr class="border-b last:border-0">
                    <td class="p-3">
                        <a href="{{ route('vacancies.show', $vacancy) }}" class="text-indigo-600 hover:underline">{{ $vacancy->title }}</a>
                    </td>
                    @if ($showCompany)
                        <td class="p-3">
                            <a href="{{ route('companies.show', $vacancy->company) }}" class="hover:underline">{{ $vacancy->company->name }}</a>
                        </td>
                    @endif
                    <td class="p-3 text-gray-500">{{ $vacancy->posted_at?->format('d.m.Y') ?? '-' }}</td>
                    <td class="p-3">{{ $vacancy->reports->count() }}</td>
                    <td class="p-3"><x-risk-badge :label="$vacancy->riskLabel()" /></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
