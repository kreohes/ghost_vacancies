<x-app-layout>
    <div class="mx-auto max-w-2xl px-4 py-8 md:py-12">
        <div class="flex items-end gap-4 px-1">
            <div class="flex-1 pb-5">
                <h1 class="font-display text-4xl leading-none font-bold sm:text-5xl">Leave a report</h1>
                <p class="mt-2 text-lg text-moss">It takes a minute and helps the next person decide where to apply.</p>
            </div>
            <x-mascot class="h-24 w-22" />
        </div>

        <form action="{{ route('userzone.reports.store') }}" method="POST" class="space-y-7 rounded-4xl bg-white p-6 sm:p-9">
            @csrf

            <div>
                <x-form.select name="vacancy_id" label="Vacancy" :options="$vacancies" :value="$selectedVacancyId" placeholder="Choose a vacancy" />
                <p class="mt-2 text-sm text-moss">Can't find it? <a href="{{ route('userzone.vacancies.create') }}" class="font-semibold text-fern underline underline-offset-2">Add the vacancy first</a>.</p>
            </div>

            <x-form.status-picker />
            <x-form.input name="applied_at" label="When did you apply?" type="date" />

            <div>
                <x-form.textarea name="comment" label="Anything to add? (optional)" />
                <p class="mt-2 text-sm text-moss">You can change your report later, for example from silence to interview.</p>
            </div>

            <div class="flex flex-wrap items-center gap-x-6 gap-y-3">
                <button type="submit" class="cursor-pointer rounded-full bg-dusk px-8 py-3.5 text-lg font-semibold text-white hover:bg-fern">Save report</button>
                <a href="{{ route('userzone.reports.index') }}" class="font-semibold text-fern underline underline-offset-2">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
