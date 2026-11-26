<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">How the risk is calculated</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 space-y-4 text-gray-700">
        <p>
            The ghost risk of a vacancy is the share of its reports with status <strong>silence</strong>.
        </p>
        <ul class="list-disc ps-6 space-y-1">
            <li>
                A silence report only counts once the application is older than {{ $silenceAfterDays }} days.
                Before that, silence is normal: the company may still answer.
            </li>
            <li>Reports with status replied or interview always count.</li>
            <li>The risk is shown only when at least {{ $minReports }} reports count. Otherwise the label is "not enough data".</li>
        </ul>

        <table class="mt-4 text-sm">
            <tr><td class="pe-4"><x-risk-badge label="high" /></td><td>60% or more of the counted reports are silence</td></tr>
            <tr><td class="pe-4 pt-2"><x-risk-badge label="medium" /></td><td class="pt-2">30% to 60%</td></tr>
            <tr><td class="pe-4 pt-2"><x-risk-badge label="low" /></td><td class="pt-2">less than 30%</td></tr>
        </table>

        <p>
            The "no answer" rate of a company uses the same rule, but over the reports of all its vacancies together.
        </p>
    </div>
</x-app-layout>
