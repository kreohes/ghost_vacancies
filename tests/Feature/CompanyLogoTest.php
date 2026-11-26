<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('a user can add a company with a logo and gets a small version', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create())
        ->post(route('userzone.companies.store'), [
            'name' => 'Lantern Labs',
            'logo' => UploadedFile::fake()->image('logo.png', 600, 600),
        ])
        ->assertRedirect();

    $logo = Company::where('name', 'Lantern Labs')->first()->getFirstMedia('logo');

    expect($logo)->not->toBeNull()
        ->and($logo->hasGeneratedConversion('thumb'))->toBeTrue();
});

test('a file that is not an image is rejected', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create())
        ->post(route('userzone.companies.store'), [
            'name' => 'Lantern Labs',
            'logo' => UploadedFile::fake()->create('cv.pdf', 100, 'application/pdf'),
        ])
        ->assertSessionHasErrors('logo');

    expect(Company::where('name', 'Lantern Labs')->exists())->toBeFalse();
});

test('an admin upload replaces the old logo', function () {
    Storage::fake('public');
    $company = Company::factory()->create();
    $company->addMedia(UploadedFile::fake()->image('old.png'))->toMediaCollection('logo');

    $this->actingAs(User::factory()->admin()->create())
        ->put(route('admin.companies.update', $company->id), [
            'name' => $company->name,
            'logo' => UploadedFile::fake()->image('new.png'),
        ]);

    expect($company->fresh()->getMedia('logo'))->toHaveCount(1)
        ->and($company->fresh()->getFirstMedia('logo')->file_name)->toBe('new.png');
});
