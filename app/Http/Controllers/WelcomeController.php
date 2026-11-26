<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Report;
use App\Models\Vacancy;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $highRiskVacancies = Vacancy::with(['company', 'reports'])
            ->latest()
            ->get()
            ->filter(fn (Vacancy $vacancy) => $vacancy->riskLabel() === 'high')
            ->take(5);

        return view('welcome', [
            'highRiskVacancies' => $highRiskVacancies,
            'vacancyCount' => Vacancy::count(),
            'companyCount' => Company::count(),
            'reportCount' => Report::count(),
        ]);
    }
}
