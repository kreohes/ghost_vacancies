<?php

use App\Models\Report;
use App\Models\User;

test('an admin can open the reports moderation', function () {
    $this->actingAs(User::factory()->admin()->create())
        ->get(route('admin.reports.index'))
        ->assertOk();
});

test('a normal user gets 403 on admin pages', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('admin.reports.index'))
        ->assertForbidden();
});

test('a guest is sent to the login page', function () {
    $this->get(route('admin.reports.index'))->assertRedirect(route('login'));
});

test('an admin can delete any report', function () {
    $report = Report::factory()->create();

    $this->actingAs(User::factory()->admin()->create())
        ->delete(route('admin.reports.destroy', $report->id))
        ->assertRedirect(route('admin.reports.index'));

    expect(Report::find($report->id))->toBeNull();
});

test('a normal user cannot manage vacancies or companies', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get(route('admin.vacancies.index'))->assertForbidden();
    $this->actingAs($user)->get(route('admin.companies.index'))->assertForbidden();
});
