@props(['company', 'size' => 'size-10'])

@if ($company->logoUrl())
    <img src="{{ $company->logoUrl() }}" alt="" {{ $attributes->merge(['class' => $size.' shrink-0 rounded-2xl object-cover']) }}>
@else
    <span {{ $attributes->merge(['class' => $size.' grid shrink-0 place-items-center rounded-2xl bg-lamp font-display font-bold text-dusk']) }} aria-hidden="true">{{ mb_strtoupper(mb_substr($company->name, 0, 1)) }}</span>
@endif
