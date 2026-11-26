@props(['code', 'title'])

<x-app-layout>
    <div class="mx-auto max-w-2xl px-4 py-12">
        <section class="flex flex-wrap items-center gap-x-8 gap-y-4 rounded-[2.5rem] bg-dusk p-8 text-white sm:p-10">
            <x-mascot class="h-28 w-26" />
            <div class="min-w-48 flex-1">
                <p class="font-display text-lg font-semibold text-lamp">Error {{ $code }}</p>
                <h1 class="mt-1 font-display text-4xl leading-tight font-bold">{{ $title }}</h1>
                <p class="mt-3 text-lg text-white/80">{{ $slot }}</p>
                <a href="{{ route('welcome') }}" class="mt-6 inline-block rounded-full bg-lamp px-6 py-3 font-semibold text-dusk hover:bg-white">Back to the home page</a>
            </div>
        </section>
    </div>
</x-app-layout>
