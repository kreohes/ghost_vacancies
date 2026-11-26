<?php

use App\Models\Report;
use App\Models\User;
use App\Models\Vacancy;
use App\Notifications\NewReportOnYourVacancy;
use Illuminate\Support\Facades\Notification;

function reportData(Vacancy $vacancy): array
{
    return [
        'vacancy_id' => $vacancy->id,
        'status' => 'silence',
        'applied_at' => now()->subDays(20)->format('Y-m-d'),
        'comment' => 'No answer after three weeks.',
    ];
}

test('the author of the vacancy gets an email about a new report', function () {
    Notification::fake();
    $vacancy = Vacancy::factory()->create();

    $this->actingAs(User::factory()->create())
        ->post(route('userzone.reports.store'), reportData($vacancy));

    Notification::assertSentTo($vacancy->user, NewReportOnYourVacancy::class);
});

test('nobody gets an email when you report your own vacancy', function () {
    Notification::fake();
    $vacancy = Vacancy::factory()->create();

    $this->actingAs($vacancy->user)
        ->post(route('userzone.reports.store'), reportData($vacancy));

    Notification::assertNothingSent();
});

test('the email names the vacancy, the status and links to the page', function () {
    $vacancy = Vacancy::factory()->create(['title' => 'Junior Laravel Developer']);
    $report = Report::factory()->create(['vacancy_id' => $vacancy->id, 'status' => 'silence']);

    $mail = (new NewReportOnYourVacancy($report))->toMail($vacancy->user);

    expect($mail->subject)->toBe('New report on Junior Laravel Developer')
        ->and(implode(' ', $mail->introLines))->toContain('reported: silence')
        ->and($mail->actionUrl)->toBe(route('vacancies.show', $vacancy));
});
