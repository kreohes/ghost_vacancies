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
    private const DESCRIPTIONS = [
        'We are looking for an engineer to join our platform team. You will design and build backend services together with product managers and designers. Requirements: 3+ years of experience, good knowledge of SQL, experience with code review and testing.',
        'Our customer support team is growing. You will answer client questions by email and chat, work with the product team on recurring issues and help improve our help center. We offer a competitive salary, health insurance and a friendly team.',
        'Join our marketing team as an analyst. You will build dashboards, run experiments and present the results to the team leads. Experience with analytics tools and strong communication skills are required.',
        'We are hiring a project manager for our client projects. You will plan sprints, talk to customers and keep the team focused on delivery. Experience in software development projects is a plus.',
        'Work from home and earn money daily. No experience needed, we provide training. Data entry and typing, only a computer and internet access required. Earn extra income, start today, send us your details to apply.',
        'Urgently needed: administrative assistant, part time, work from home. Weekly pay by wire transfer or money order. No interview, apply now and start earning this week.',
    ];

    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->optional(0.8)->randomElement(self::DESCRIPTIONS),
            'url' => fake()->optional(0.8)->url(),
            'posted_at' => fake()->optional(0.8)->dateTimeBetween('-4 months', '-2 weeks'),
            'company_id' => Company::factory(),
            'user_id' => User::factory(),
        ];
    }
}
