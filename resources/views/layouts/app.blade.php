<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body class="bg-butter font-body text-dusk antialiased">
<x-icon-sprite />

<div class="min-h-screen">
    @include('layouts.app_navigation')

    @isset($header)
        <header class="mx-auto max-w-6xl px-4 pt-6">
            {{ $header }}
        </header>
    @endisset

    <main>
        {{ $slot }}
    </main>

    <footer class="px-4 py-6 mt-10">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center gap-x-8 gap-y-3 rounded-4xl bg-dusk px-6 py-6 text-white sm:px-8">
            <a href="{{ route('welcome') }}" class="flex items-center gap-2.5 font-display text-lg font-bold">
                <span class="grid size-8 place-items-center rounded-full bg-lamp">
                    <svg class="size-5 fill-dusk" aria-hidden="true"><use href="#ghost"/></svg>
                </span>
                {{ config('app.name') }}
            </a>
            <nav class="flex flex-wrap gap-x-5 gap-y-1 font-medium">
                @foreach ($menu as $label => $link)
                    <a href="{{ $link }}" class="hover:underline">{{ $label }}</a>
                @endforeach
            </nav>
            <p class="w-full text-sm text-white/70 lg:ml-auto lg:w-auto">Reports come from applicants. A label is a statistic, not a verdict.</p>
        </div>
    </footer>
</div>
</body>
</html>
