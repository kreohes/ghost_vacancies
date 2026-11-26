<?php

use App\Models\Vacancy;
use App\Support\ScamModel;

test('php gives the same probability as the python model', function () {
    $examples = json_decode(file_get_contents(base_path('tests/fixtures/scam-model-examples.json')), true);

    expect($examples)->not->toBeEmpty();

    foreach ($examples as $example) {
        expect(ScamModel::probability($example['text']))->toEqualWithDelta($example['probability'], 0.000001);
    }
});

test('top words are the known words with the largest positive weights', function () {
    $words = ScamModel::topWords('Data entry clerk, work from home, earn money daily, no experience');

    expect($words)->toHaveCount(3)->toContain('earn');
});

test('a vacancy without description has no scam probability', function () {
    $vacancy = Vacancy::factory()->create(['description' => null]);

    expect($vacancy->scamProbability())->toBeNull();
});

test('a vacancy with description gets a probability between 0 and 1', function () {
    $vacancy = Vacancy::factory()->create([
        'title' => 'Data entry clerk',
        'description' => 'Work from home and earn money daily. No experience needed.',
    ]);

    expect($vacancy->scamProbability())->toBeGreaterThan(0.5)->toBeLessThan(1);
});

test('the vacancy page shows the scam signal only when there is a description', function () {
    $withText = Vacancy::factory()->create(['description' => 'Work from home and earn money daily.']);
    $withoutText = Vacancy::factory()->create(['description' => null]);

    $this->get(route('vacancies.show', $withText))->assertOk()->assertSee('Scam signal');
    $this->get(route('vacancies.show', $withoutText))->assertOk()->assertDontSee('Scam signal');
});

test('the scam label follows the thresholds', function () {
    expect(ScamModel::label(0.9))->toBe('likely scam')
        ->and(ScamModel::label(0.5))->toBe('likely scam')
        ->and(ScamModel::label(0.3))->toBe('suspicious')
        ->and(ScamModel::label(0.2))->toBe('suspicious')
        ->and(ScamModel::label(0.05))->toBe('looks normal');
});

test('a vacancy without description has no scam label', function () {
    $vacancy = Vacancy::factory()->create(['description' => null]);

    expect($vacancy->scamLabel())->toBeNull();
});
