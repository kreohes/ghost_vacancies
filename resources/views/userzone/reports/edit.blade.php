<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h2 class="font-display text-4xl font-bold">Update your report</h2>
            <p class="text-moss">{{ $report->vacancy->title }} at {{ $report->vacancy->company->name }}</p>
        </div>

        <form action="{{ route('userzone.reports.update', $report->id) }}" method="POST" class="bg-white rounded-3xl p-6 space-y-4">
            @csrf
            @method('PUT')

            <x-form.status-picker :value="$report->status" />
            <x-form.input name="applied_at" label="Applied on" type="date" :value="$report->applied_at->format('Y-m-d')" />
            <x-form.textarea name="comment" label="Comment (optional)" :value="$report->comment" />

            <button type="submit" class="rounded-full bg-dusk px-4 py-2 text-white hover:bg-fern">Save changes</button>
        </form>
    </div>
</x-app-layout>
