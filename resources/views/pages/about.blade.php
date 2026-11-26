<x-app-layout>
    <div class="mx-auto max-w-4xl space-y-4 px-4 py-8 md:py-12">
        <section class="flex flex-wrap items-end gap-x-8 gap-y-4 rounded-[2.5rem] bg-dusk p-6 text-white sm:p-10">
            <div class="min-w-64 flex-1">
                <h1 class="font-display text-4xl leading-tight font-bold sm:text-5xl">Applied and never heard back?</h1>
                <p class="mt-4 max-w-xl text-lg leading-relaxed text-white/80">
                    You are not alone. Ghost Vacancies collects what really happened after people applied,
                    so the next person knows which postings are worth a cover letter.
                </p>
            </div>
            <x-mascot class="h-28 w-26" />
        </section>

        <section class="rounded-4xl bg-white p-6 sm:p-8">
            <h2 class="font-display text-2xl font-semibold">What is a ghost vacancy?</h2>
            <p class="mt-2 text-lg leading-relaxed">
                A job posting where nobody is actually being hired. You apply, and then: nothing.
                Companies keep these postings online for different reasons:
            </p>
            <ul class="mt-5 grid gap-3 sm:grid-cols-3">
                <li class="rounded-3xl bg-butter p-5">
                    <p class="font-display text-lg font-semibold">To look like they grow</p>
                    <p class="mt-1 text-moss">Many open roles make a company look busy and successful.</p>
                </li>
                <li class="rounded-3xl bg-butter p-5">
                    <p class="font-display text-lg font-semibold">To collect CVs</p>
                    <p class="mt-1 text-moss">Applications are kept "for later", even without a real opening.</p>
                </li>
                <li class="rounded-3xl bg-butter p-5">
                    <p class="font-display text-lg font-semibold">Nobody removed it</p>
                    <p class="mt-1 text-moss">The role was filled months ago, but the posting stayed online.</p>
                </li>
            </ul>
        </section>

        <section class="rounded-4xl bg-white p-6 sm:p-8">
            <h2 class="font-display text-2xl font-semibold">How it works</h2>
            <ol class="mt-5 grid gap-3 md:grid-cols-3">
                <li class="rounded-3xl border-2 border-crust p-5">
                    <p class="font-display text-sm font-semibold text-fern">Step 1</p>
                    <p class="mt-1 font-display text-lg font-semibold">Add the vacancy</p>
                    <p class="mt-1 text-moss">Title, company and a link to the posting. Paste its text if you like.</p>
                </li>
                <li class="rounded-3xl border-2 border-crust p-5">
                    <p class="font-display text-sm font-semibold text-fern">Step 2</p>
                    <p class="mt-1 font-display text-lg font-semibold">Report what happened</p>
                    <p class="mt-2 flex flex-wrap gap-1.5">
                        <x-status-pill status="silence" />
                        <x-status-pill status="replied" />
                        <x-status-pill status="interview" />
                    </p>
                    <p class="mt-2 text-moss">One report per vacancy. Update it when they finally answer.</p>
                </li>
                <li class="rounded-3xl border-2 border-crust p-5">
                    <p class="font-display text-sm font-semibold text-fern">Step 3</p>
                    <p class="mt-1 font-display text-lg font-semibold">See the ghost risk</p>
                    <p class="mt-2 text-high"><x-risk-ghosts label="high" size="size-7" /></p>
                    <p class="mt-2 text-moss">Every vacancy gets a risk label, every company a "no answer" rate.</p>
                </li>
            </ol>
            <p class="mt-5">
                <a href="{{ route('risk') }}" class="font-semibold text-fern underline underline-offset-2">Read how the risk is calculated</a>
            </p>
        </section>

        <section class="flex flex-wrap items-center gap-x-5 gap-y-3 rounded-4xl bg-lamp p-5 sm:px-8">
            <p class="min-w-48 flex-1 font-display text-xl font-semibold">Every report helps the next person decide where to apply.</p>
            <a href="{{ route('vacancies.index') }}" class="rounded-full bg-white px-5 py-2.5 font-semibold hover:bg-butter">Browse vacancies</a>
            @auth
                <a href="{{ route('userzone.reports.create') }}" class="rounded-full bg-dusk px-5 py-2.5 font-semibold text-white hover:bg-fern">Leave a report</a>
            @else
                <a href="{{ route('register') }}" class="rounded-full bg-dusk px-5 py-2.5 font-semibold text-white hover:bg-fern">Create an account</a>
            @endauth
        </section>
    </div>
</x-app-layout>
