<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h2 class="font-display text-4xl font-bold">Companies</h2>
        </div>

        <table class="w-full bg-white rounded-3xl text-sm">
            <thead class="text-left text-moss border-b">
                <tr>
                    <th class="p-3">Company</th>
                    <th class="p-3">Vacancies</th>
                    <th class="p-3">Reports</th>
                    <th class="p-3">"No answer" rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr class="border-b last:border-0">
                        <td class="p-3">
                            <a href="{{ route('companies.show', $company) }}" class="flex items-center gap-3 text-fern hover:underline">
                                <x-company-logo :company="$company" size="size-9" />
                                {{ $company->name }}
                            </a>
                        </td>
                        <td class="p-3">{{ $company->vacancies_count }}</td>
                        <td class="p-3">{{ $company->reports->count() }}</td>
                        <td class="p-3">
                            @if ($company->noAnswerRate() === null)
                                <span class="text-moss">not enough data</span>
                            @else
                                {{ round($company->noAnswerRate() * 100) }}%
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
