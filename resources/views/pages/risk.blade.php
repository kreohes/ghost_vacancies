<x-app-layout>
    <div class="mx-auto max-w-4xl space-y-4 px-4 py-8 md:py-12">
        <section class="flex flex-wrap items-end gap-x-8 gap-y-4 rounded-[2.5rem] bg-dusk p-6 text-white sm:p-10">
            <div class="min-w-64 flex-1">
                <h1 class="font-display text-4xl leading-tight font-bold sm:text-5xl">How the risk is calculated</h1>
                <p class="mt-4 max-w-xl text-lg leading-relaxed text-white/80">
                    No magic: the ghost risk is simply the share of people who never got an answer.
                </p>
            </div>
            <x-mascot class="h-28 w-26" />
        </section>

        <section class="rounded-4xl bg-white p-6 sm:p-8">
            <h2 class="font-display text-2xl font-semibold">The formula</h2>
            <p class="mt-4 flex flex-wrap items-center gap-3 font-display text-xl font-semibold sm:text-2xl">
                <span class="rounded-full bg-lamp px-4 py-1.5">Ghost risk</span>
                <span>=</span>
                <span class="rounded-full bg-silence-soft px-4 py-1.5 text-silence">silence reports</span>
                <span>/</span>
                <span class="rounded-full bg-butter px-4 py-1.5">counted reports</span>
            </p>

            <ul class="mt-6 grid gap-3 md:grid-cols-3">
                <li class="rounded-3xl bg-butter p-5">
                    <x-status-pill status="silence" />
                    <p class="mt-3 font-display text-lg font-semibold">Silence waits {{ $silenceAfterDays }} days</p>
                    <p class="mt-1 text-moss">A fresh silence is normal, the company may still answer. It counts once the application is {{ $silenceAfterDays }} days old.</p>
                </li>
                <li class="rounded-3xl bg-butter p-5">
                    <p class="flex flex-wrap gap-1.5"><x-status-pill status="replied" /><x-status-pill status="interview" /></p>
                    <p class="mt-3 font-display text-lg font-semibold">Answers always count</p>
                    <p class="mt-1 text-moss">A reply (a rejection too) or an interview counts from the first day.</p>
                </li>
                <li class="rounded-3xl bg-butter p-5">
                    <span class="text-nodata"><x-risk-ghosts label="not enough data" /></span>
                    <p class="mt-3 font-display text-lg font-semibold">At least {{ $minReports }} reports</p>
                    <p class="mt-1 text-moss">With fewer than {{ $minReports }} counted reports we say "not enough data" instead of guessing.</p>
                </li>
            </ul>
        </section>

        <section class="rounded-4xl bg-white p-6 sm:p-8">
            <h2 class="font-display text-2xl font-semibold">An example</h2>
            <p class="mt-2 text-lg">Five people reported on one vacancy:</p>
            <ul class="mt-4 flex flex-wrap gap-2">
                <li class="grid size-11 place-items-center rounded-full bg-silence text-white" title="silence, 40 days ago"><svg class="size-5" aria-hidden="true"><use href="#silence"/></svg></li>
                <li class="grid size-11 place-items-center rounded-full bg-silence text-white" title="silence, 30 days ago"><svg class="size-5" aria-hidden="true"><use href="#silence"/></svg></li>
                <li class="grid size-11 place-items-center rounded-full bg-silence text-white" title="silence, 20 days ago"><svg class="size-5" aria-hidden="true"><use href="#silence"/></svg></li>
                <li class="grid size-11 place-items-center rounded-full bg-replied-soft text-replied" title="replied"><svg class="size-5" aria-hidden="true"><use href="#replied"/></svg></li>
                <li class="grid size-11 place-items-center rounded-full bg-silence text-white opacity-40" title="silence, 5 days ago, not counted yet"><svg class="size-5" aria-hidden="true"><use href="#silence"/></svg></li>
            </ul>
            <ol class="mt-5 space-y-2 text-lg">
                <li>The last silence is only 5 days old, so it does not count yet: <strong>4 counted reports</strong>.</li>
                <li>3 of those 4 are silence: 3 / 4 = <strong>75%</strong>.</li>
                <li class="flex flex-wrap items-center gap-2">75% is more than 60%, so the vacancy gets <x-risk-badge label="high" /></li>
            </ol>
        </section>

        <section class="rounded-4xl bg-white p-6 sm:p-8">
            <h2 class="font-display text-2xl font-semibold">The labels</h2>
            <x-ghost-legend class="mt-4" />
            <p class="mt-5 text-lg leading-relaxed">
                The <strong>"no answer" rate of a company</strong> uses the same rule, but over the reports of all its vacancies together.
            </p>
        </section>

        <section id="scam-signal" class="rounded-4xl bg-white p-6 sm:p-8">
            <h2 class="font-display text-2xl font-semibold">Scam signal</h2>
            <p class="mt-2 text-lg leading-relaxed">
                If a vacancy has the text of the posting, we also show how much the text looks like a fraudulent job ad.
                It is a separate number and does not change the ghost risk.
            </p>

            <ol class="mt-5 grid gap-3 md:grid-cols-3">
                <li class="rounded-3xl border-2 border-crust p-5">
                    <p class="font-display text-lg font-semibold">1. Words</p>
                    <p class="mt-1 text-moss">The title and the text are split into lowercase words. Each known word counts once.</p>
                </li>
                <li class="rounded-3xl border-2 border-crust p-5">
                    <p class="font-display text-lg font-semibold">2. Weights</p>
                    <p class="mt-1 text-moss">Every word has a weight learned by a logistic regression. Words like <span class="rounded-full bg-peach px-2 font-semibold">earn</span> raise the score, normal job words lower it.</p>
                </li>
                <li class="rounded-3xl border-2 border-crust p-5">
                    <p class="font-display text-lg font-semibold">3. Probability</p>
                    <p class="mt-1 text-moss">The weights are added up and a sigmoid turns the sum into a number from 0% to 100%.</p>
                </li>
            </ol>

            <ul class="mt-5 grid grid-cols-3 gap-3 text-center">
                <li class="rounded-3xl bg-butter px-2 py-4"><strong class="block font-display text-3xl font-bold">17,880</strong><span class="text-moss">job postings</span></li>
                <li class="rounded-3xl bg-butter px-2 py-4"><strong class="block font-display text-3xl font-bold">866</strong><span class="text-moss">marked as fraud</span></li>
                <li class="rounded-3xl bg-butter px-2 py-4"><strong class="block font-display text-3xl font-bold">0.78</strong><span class="text-moss">PR-AUC (random: 0.05)</span></li>
            </ul>

            <p class="mt-5 rounded-3xl bg-high-soft p-5 leading-relaxed text-high">
                The model learned from public postings from 2012-2014 (the EMSCAD dataset), labelled as fraud, not as ghost vacancies.
                Treat the number as a hint to read the posting more carefully, not as a verdict.
            </p>
        </section>
    </div>
</x-app-layout>
