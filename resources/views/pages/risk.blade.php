<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-4xl font-bold">How the risk is calculated</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 space-y-4 text-dusk">
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

        <h3 id="scam-signal" class="font-display text-2xl font-semibold pt-4">Scam signal</h3>
        <p>
            If a vacancy has the text of the posting, we also show a scam signal: how much the text looks like a fraudulent job ad.
            It is a separate number and does not change the ghost risk.
        </p>
        <ul class="list-disc ps-6 space-y-1">
            <li>The title and the text are split into lowercase words. Each known word counts once, no matter how often it appears (a "bag of words").</li>
            <li>Every word has a weight learned by a logistic regression: positive weights raise the score, negative ones lower it.</li>
            <li>The weights of the words in the text are added to a starting value, and a sigmoid turns the sum into a probability from 0% to 100%.</li>
            <li>The page shows the three words of the text with the largest positive weights.</li>
        </ul>
        <p>
            The model was trained on EMSCAD, a public dataset of 17,880 English job postings from 2012-2014, where 866 are marked as fraudulent.
            On postings it had not seen it reaches a PR-AUC of 0.78 (a random guess would get about 0.05).
        </p>
        <p>
            The labels are about fraud, not about ghost vacancies, and the postings are old.
            So treat the number as a hint to read the posting more carefully, not as a verdict.
        </p>
    </div>
</x-app-layout>
