<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Companies</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4">
        <table class="w-full bg-white shadow-xs rounded-lg text-sm">
            <thead class="text-left text-gray-500 border-b">
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
                            <a href="{{ route('companies.show', $company) }}" class="text-indigo-600 hover:underline">{{ $company->name }}</a>
                        </td>
                        <td class="p-3">{{ $company->vacancies_count }}</td>
                        <td class="p-3">{{ $company->reports->count() }}</td>
                        <td class="p-3">
                            @if ($company->noAnswerRate() === null)
                                <span class="text-gray-500">not enough data</span>
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
