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
           class="rounded-md px-3 py-1 {{ request()->routeIs($routeName) ? 'bg-gray-800 text-white' : 'bg-white text-gray-700 hover:bg-gray-200' }}">{{ $label }}</a>
    @endforeach
</div>
