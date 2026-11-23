<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vacancy>
 */
class VacancyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'url' => fake()->optional(0.8)->url(),
            'posted_at' => fake()->optional(0.8)->dateTimeBetween('-4 months', '-2 weeks'),
            'company_id' => Company::factory(),
            'user_id' => User::factory(),
        ];
    }
}
