<?php

use App\Models\Vacancy;

test('a known link leads to the vacancy page', function () {
    $vacancy = Vacancy::factory()->create(['url' => 'https://jobs.example.com/123']);

    $this->get(route('check.url', ['url' => 'https://jobs.example.com/123/']))
        ->assertRedirect(route('vacancies.show', $vacancy));
});

test('an unknown link shows that nobody reported it yet', function () {
    $this->get(route('check.url', ['url' => 'https://jobs.example.com/unknown']))
        ->assertOk()
        ->assertSee('Nobody has reported this vacancy yet');
});

test('something that is not a link gives a validation error', function () {
    $this->from(route('welcome'))
        ->get(route('check.url', ['url' => 'not a link']))
        ->assertRedirect(route('welcome'))
        ->assertSessionHasErrors('url');
});

test('a pasted posting text gets a scam signal', function () {
    $this->post(route('check.text'), [
        'url' => 'https://jobs.example.com/unknown',
        'text' => 'Work from home and earn money daily. No experience needed, data entry only.',
    ])
        ->assertOk()
        ->assertSee('Scam signal');
});
