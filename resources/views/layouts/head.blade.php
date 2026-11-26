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
