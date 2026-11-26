<ul {{ $attributes->merge(['class' => 'grid gap-3 sm:grid-cols-2 lg:grid-cols-4']) }}>
    <li class="rounded-3xl bg-high-soft p-5 text-high">
        <x-risk-ghosts label="high" size="size-9" />
        <p class="mt-3 font-display text-xl font-semibold">High risk</p>
        <p class="text-dusk">60% or more of the reports are silence</p>
    </li>
    <li class="rounded-3xl bg-medium-soft p-5 text-medium">
        <x-risk-ghosts label="medium" size="size-9" />
        <p class="mt-3 font-display text-xl font-semibold">Medium risk</p>
        <p class="text-dusk">30% to 60% silence</p>
    </li>
    <li class="rounded-3xl bg-low-soft p-5 text-low">
        <x-risk-ghosts label="low" size="size-9" />
        <p class="mt-3 font-display text-xl font-semibold">Low risk</p>
        <p class="text-dusk">Less than 30% silence</p>
    </li>
    <li class="rounded-3xl bg-nodata-soft p-5 text-nodata">
        <x-risk-ghosts label="not enough data" size="size-9" />
        <p class="mt-3 font-display text-xl font-semibold">Not enough data</p>
        <p class="text-dusk">Fewer than 3 counted reports</p>
    </li>
</ul>
