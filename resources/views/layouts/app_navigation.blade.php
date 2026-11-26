<header class="mx-auto flex max-w-6xl flex-wrap items-center gap-x-6 gap-y-3 px-4 py-4">
    <a href="{{ route('welcome') }}" class="flex items-center gap-2.5 font-display text-xl font-bold">
        <span class="grid size-10 place-items-center rounded-full bg-lamp">
            <svg class="size-6 fill-dusk animate-float motion-reduce:animate-none" aria-hidden="true"><use href="#ghost"/></svg>
        </span>
        {{ config('app.name') }}
    </a>

    <nav class="order-last flex w-full flex-wrap items-center gap-1 font-medium lg:order-none lg:w-auto lg:flex-1">
        @foreach ($menu as $label => $link)
            <x-nav-pill :href="$link" :active="str_starts_with(request()->url(), $link)">{{ $label }}</x-nav-pill>
        @endforeach

        @auth
            <x-nav-pill :href="route('userzone.reports.index')" :active="request()->routeIs('userzone.reports.*')">My reports</x-nav-pill>
            <x-nav-pill :href="route('userzone.vacancies.index')" :active="request()->routeIs('userzone.vacancies.*')">My vacancies</x-nav-pill>
            @if (auth()->user()->is_admin)
                <x-nav-pill :href="route('admin.reports.index')" :active="request()->routeIs('admin.*')">Admin</x-nav-pill>
            @endif
        @endauth
    </nav>

    @auth
        <details class="relative ml-auto">
            <summary class="flex cursor-pointer list-none items-center gap-2 rounded-full bg-white px-4 py-2 font-medium hover:bg-crust [&::-webkit-details-marker]:hidden">
                {{ auth()->user()->name }} &#9662;
            </summary>
            <div class="absolute right-0 z-10 mt-2 w-44 rounded-2xl bg-white p-1.5 shadow-lg shadow-dusk/15">
                <a href="{{ route('dashboard') }}" class="block rounded-xl px-3 py-2 hover:bg-butter">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="block rounded-xl px-3 py-2 hover:bg-butter">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full cursor-pointer rounded-xl px-3 py-2 text-left hover:bg-butter">Log out</button>
                </form>
            </div>
        </details>
    @else
        <div class="ml-auto flex items-center gap-2 font-medium">
            <a href="{{ route('login') }}" class="rounded-full px-4 py-2 hover:bg-crust">Log in</a>
            <a href="{{ route('register') }}" class="rounded-full bg-dusk px-4 py-2 text-white hover:bg-fern">Register</a>
        </div>
    @endauth
</header>
