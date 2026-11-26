@php
    $tabs = [
        'Reports' => 'admin.reports.index',
        'Vacancies' => 'admin.vacancies.index',
        'Companies' => 'admin.companies.index',
    ];
@endphp

<div class="mb-4 flex gap-2 text-sm">
    @foreach ($tabs as $label => $routeName)
        <a href="{{ route($routeName) }}"
           class="rounded-full px-3 py-1 {{ request()->routeIs($routeName) ? 'bg-dusk text-white' : 'bg-white text-dusk hover:bg-crust' }}">{{ $label }}</a>
    @endforeach
</div>
