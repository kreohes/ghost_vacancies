<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-4xl font-bold">Vacancies I added</h2>
            <a href="{{ route('userzone.vacancies.create') }}" class="rounded-full bg-dusk px-4 py-2 text-sm text-white hover:bg-fern">+ Add a vacancy</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 space-y-3">
        @forelse ($vacancies as $vacancy)
            <div class="bg-white rounded-3xl p-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <a href="{{ route('vacancies.show', $vacancy) }}" class="font-semibold text-dusk hover:underline">{{ $vacancy->title }}</a>
                        <p class="text-sm text-moss">{{ $vacancy->company->name }} · {{ $vacancy->reports->count() }} reports</p>
                    </div>
                    <x-risk-badge :label="$vacancy->riskLabel()" />
                </div>

                <div class="mt-3 flex items-center gap-4 text-sm">
                    <a href="{{ route('userzone.vacancies.edit', $vacancy->id) }}" class="text-fern hover:underline">Edit</a>
                    <form action="{{ route('userzone.vacancies.destroy', $vacancy->id) }}" method="POST" onsubmit="return confirm('Delete this vacancy and all its reports?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl p-8 text-center text-moss">
                You have not added any vacancies yet.
            </div>
        @endforelse
    </div>
</x-app-layout>
