<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Report;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $users = User::factory(10)->create()->push($admin, $testUser);

        $companies = Company::factory(8)->create();
        Company::factory()->create();

        Vacancy::factory(3)->recycle($companies)->create(['user_id' => $admin->id]);
        Vacancy::factory(25)->recycle($users)->recycle($companies)->create();

        foreach (Vacancy::all() as $vacancy) {
            $silenceChance = fake()->randomElement([10, 50, 90]);
            $reporters = $users->random(rand(0, 7));

            foreach ($reporters as $reporter) {
                Report::factory()->create([
                    'vacancy_id' => $vacancy->id,
                    'user_id' => $reporter->id,
                    'status' => fake()->boolean($silenceChance)
                        ? 'silence'
                        : fake()->randomElement(['replied', 'interview']),
                ]);
            }
        }
    }
}
