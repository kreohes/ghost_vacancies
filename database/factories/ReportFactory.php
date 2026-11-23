<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(Report::STATUSES),
            'applied_at' => fake()->dateTimeBetween('-2 months', 'now'),
            'comment' => fake()->optional(0.5)->sentence(),
            'vacancy_id' => Vacancy::factory(),
            'user_id' => User::factory(),
        ];
    }
}
