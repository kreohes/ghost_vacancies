<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body class="bg-butter font-body text-dusk antialiased">
<x-icon-sprite />

<div class="flex min-h-screen flex-col items-center px-4 pt-10 pb-10 sm:justify-center sm:pt-0">
    <a href="{{ route('welcome') }}" class="flex items-center gap-2.5 font-display text-2xl font-bold">
        <span class="grid size-11 place-items-center rounded-full bg-lamp">
            <svg class="size-6 fill-dusk animate-float motion-reduce:animate-none" aria-hidden="true"><use href="#ghost"/></svg>
        </span>
        {{ config('app.name') }}
    </a>

    <div class="mt-6 w-full rounded-4xl bg-white p-6 sm:max-w-md sm:p-8">
        {{ $slot }}
    </div>
</div>
</body>
</html>
