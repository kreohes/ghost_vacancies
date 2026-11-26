<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 pt-2 pb-6">
        <section class="grid items-center gap-x-8 gap-y-4 overflow-hidden rounded-[2.5rem] bg-dusk px-6 pt-10 text-white sm:px-10 md:grid-cols-[1.2fr_1fr] md:py-6 lg:px-14">
            <div class="md:py-10">
                <h1 class="font-display text-[2.6rem] leading-[1.02] font-bold text-balance sm:text-6xl sm:leading-none">Heard nothing back? Let's shine a light on that.</h1>
                <p class="mt-5 max-w-lg text-lg leading-relaxed text-white/80">
                    Some vacancies stay online long after anyone stopped reading applications.
                    People who applied tell here what happened next, so you can spot a ghost vacancy before you write a cover letter.
                </p>
                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="{{ route('vacancies.index') }}" class="rounded-full bg-lamp px-6 py-3 font-semibold text-dusk hover:bg-white">Browse vacancies</a>
                    <a href="{{ route('companies.index') }}" class="rounded-full border-2 border-white/30 px-6 py-3 font-semibold hover:border-white">Browse companies</a>
                </div>
            </div>

            <x-lantern-scene />
        </section>

        <form action="{{ route('check.url') }}" method="GET" class="mt-4 rounded-3xl bg-white p-5 sm:p-6">
            <label for="url" class="block font-display text-xl font-semibold">Got a link to a vacancy? Check it before you apply.</label>
            <div class="mt-3 flex flex-wrap gap-3">
                <input type="url" id="url" name="url" value="{{ old('url') }}" placeholder="https://..."
                       @class([
                           'min-w-0 flex-1 basis-64 rounded-2xl border-2 px-4 py-3 focus:outline-2 focus:outline-offset-2',
                           'border-high bg-high-soft/50 focus:outline-high' => $errors->has('url'),
                           'border-crust hover:border-fern focus:border-fern focus:outline-fern' => ! $errors->has('url'),
                       ])>
                <button type="submit" class="cursor-pointer rounded-full bg-dusk px-6 py-3 font-semibold text-white hover:bg-fern">Check vacancy</button>
            </div>
            @error('url')
                <p class="mt-2 inline-block rounded-2xl bg-high-soft px-4 py-2 text-sm font-semibold text-high">{{ $message }}</p>
            @enderror
        </form>

        <ul class="mt-4 grid grid-cols-3 gap-3 text-center sm:gap-4">
            <li class="rounded-3xl bg-white px-2 py-4"><strong class="block font-display text-4xl font-bold">{{ $vacancyCount }}</strong><span class="text-moss">vacancies</span></li>
            <li class="rounded-3xl bg-white px-2 py-4"><strong class="block font-display text-4xl font-bold">{{ $companyCount }}</strong><span class="text-moss">companies</span></li>
            <li class="rounded-3xl bg-white px-2 py-4"><strong class="block font-display text-4xl font-bold">{{ $reportCount }}</strong><span class="text-moss">reports</span></li>
        </ul>

        <section class="mt-14">
            <h2 class="font-display text-3xl font-bold sm:text-4xl">Latest high-risk vacancies</h2>
            <p class="mt-1 mb-6 text-lg text-moss">Most people who applied to these never heard back. Good to know before you apply.</p>

            <x-vacancy-cards :vacancies="$highRiskVacancies">
                <li class="flex flex-col items-start gap-3 rounded-3xl bg-lamp p-5">
                    <x-mascot class="h-16 w-15" />
                    <p class="font-display text-2xl leading-tight font-semibold">{{ $vacancyCount - $highRiskVacancies->count() }} more vacancies, and plenty of them do answer.</p>
                    <a href="{{ route('vacancies.index') }}" class="mt-auto rounded-full bg-dusk px-5 py-2 font-semibold text-white hover:bg-fern">See all vacancies</a>
                </li>
            </x-vacancy-cards>
        </section>

        <section class="mt-14">
            <h2 class="font-display text-3xl font-bold">What the ghosts mean</h2>
            <ul class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                <li class="rounded-3xl bg-high-soft p-5 text-high">
                    <x-risk-ghosts label="high" size="size-9" />
                    <p class="mt-3 font-display text-xl font-semibold">High risk</p>
                    <p class="text-dusk">60% or more of the reports are silence</p>
                </li>
                <li class="rounded-3xl bg-medium-soft p-5 text-medium">
                    <x-risk-ghosts label="medium" size="size-9" />
                    <p class="mt-3 font-display text-xl font-semibold">Medium risk</p>
                    <p class="text-dusk">30% to 60% silence</p>
                </li>
                <li class="rounded-3xl bg-low-soft p-5 text-low">
                    <x-risk-ghosts label="low" size="size-9" />
                    <p class="mt-3 font-display text-xl font-semibold">Low risk</p>
                    <p class="text-dusk">Less than 30% silence</p>
                </li>
                <li class="rounded-3xl bg-nodata-soft p-5 text-nodata">
                    <x-risk-ghosts label="not enough data" size="size-9" />
                    <p class="mt-3 font-display text-xl font-semibold">Not enough data</p>
                    <p class="text-dusk">Fewer than 3 counted reports</p>
                </li>
            </ul>
            <p class="mt-4 text-moss">
                A silence report counts once the application is 14 days old, because some answers take a while.
                <a href="{{ route('risk') }}" class="font-semibold text-fern underline underline-offset-2">How the risk is calculated</a>
            </p>
        </section>
    </div>
</x-app-layout>
