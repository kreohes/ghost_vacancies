<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@500;600;700&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Tailwind CSS & Alpine.js via CDN -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    @endif

    <style type="text/tailwindcss">
        @theme {
            --font-display: "Gabarito", ui-rounded, system-ui, sans-serif;
            --font-body: "Figtree", system-ui, sans-serif;

            --color-butter: #FFF4D9;
            --color-crust: #F3E2B5;
            --color-dusk: #1D3B36;
            --color-fern: #2C7560;
            --color-moss: #58695F;
            --color-lamp: #FFBE3B;
            --color-peach: #FFDCC4;

            --color-high: #B13A2C;
            --color-high-soft: #FFE0D6;
            --color-medium: #865500;
            --color-medium-soft: #FFE6A6;
            --color-low: #226B4B;
            --color-low-soft: #D8F0DB;
            --color-nodata: #5C6660;
            --color-nodata-soft: #ECE9DD;

            --color-silence: #4F4F7C;
            --color-silence-soft: #E6E4F5;
            --color-replied: #23608E;
            --color-replied-soft: #D9EAF7;
            --color-interview: #226B4B;
            --color-interview-soft: #D8F0DB;

            --animate-float: float 4s ease-in-out infinite;

            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-8px); }
            }
        }
    </style>
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
