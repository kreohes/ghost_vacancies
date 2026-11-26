<?php

use App\Models\Report;
use App\Models\Vacancy;

function reportFor(Vacancy $vacancy, string $status, int $daysAgo): Report
{
    return Report::factory()->create([
        'vacancy_id' => $vacancy->id,
        'status' => $status,
        'applied_at' => now()->subDays($daysAgo),
    ]);
}

test('a vacancy with fewer than 3 reports has not enough data', function () {
    $vacancy = Vacancy::factory()->create();
    reportFor($vacancy, 'silence', 30);
    reportFor($vacancy, 'silence', 30);

    expect($vacancy->ghostRisk())->toBeNull()
        ->and($vacancy->riskLabel())->toBe('not enough data');
});

test('old silence reports make a vacancy high risk', function () {
    $vacancy = Vacancy::factory()->create();
    reportFor($vacancy, 'silence', 30);
    reportFor($vacancy, 'silence', 20);
    reportFor($vacancy, 'interview', 5);

    expect($vacancy->ghostRisk())->toEqualWithDelta(2 / 3, 0.001)
        ->and($vacancy->riskLabel())->toBe('high');
});

test('silence younger than 14 days is not counted yet', function () {
    $vacancy = Vacancy::factory()->create();
    reportFor($vacancy, 'silence', 3);
    reportFor($vacancy, 'replied', 30);
    reportFor($vacancy, 'replied', 30);
    reportFor($vacancy, 'interview', 30);

    expect($vacancy->ghostRisk())->toEqual(0.0)
        ->and($vacancy->riskLabel())->toBe('low');
});

test('the company rate combines reports of all its vacancies', function () {
    $vacancy = Vacancy::factory()->create();
    $otherVacancy = Vacancy::factory()->for($vacancy->company)->create();
    reportFor($vacancy, 'silence', 30);
    reportFor($vacancy, 'replied', 30);
    reportFor($otherVacancy, 'silence', 30);
    reportFor($otherVacancy, 'interview', 30);

    expect($vacancy->company->noAnswerRate())->toEqual(0.5);
});
