<x-app-layout>
    <div class="mx-auto max-w-2xl space-y-4 px-4 py-8 md:py-12">
        <section class="flex flex-wrap items-center gap-x-6 gap-y-4 rounded-4xl bg-dusk p-6 text-white sm:p-8">
            <x-mascot class="h-24 w-22" />
            <div class="min-w-48 flex-1">
                <h1 class="font-display text-3xl leading-tight font-bold sm:text-4xl">Nobody has reported this vacancy yet</h1>
                <p class="mt-2 break-all text-white/70">{{ $url }}</p>
            </div>
        </section>

        <section class="rounded-4xl bg-white p-6 sm:p-8">
            <h2 class="font-display text-2xl font-semibold">So we can't say if it is a ghost</h2>
            <p class="mt-2 text-lg leading-relaxed">
                The ghost risk comes from people who applied and told what happened next.
                Add this vacancy, and once 3 people report on it, you will see its risk.
            </p>
            <div class="mt-5 flex flex-wrap gap-3">
                @auth
                    <a href="{{ route('userzone.vacancies.create', ['url' => $url]) }}" class="rounded-full bg-dusk px-5 py-2.5 font-semibold text-white hover:bg-fern">Add this vacancy</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-full bg-dusk px-5 py-2.5 font-semibold text-white hover:bg-fern">Log in to add it</a>
                @endauth
                <a href="{{ route('welcome') }}" class="rounded-full px-5 py-2.5 font-semibold text-fern hover:bg-butter">Check another link</a>
            </div>
        </section>
    </div>
</x-app-layout>
