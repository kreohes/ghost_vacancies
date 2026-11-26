<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::with(['company', 'reports'])->latest()->get();

        return view('vacancies.index', compact('vacancies'));
    }

    public function show($id)
    {
        $vacancy = Vacancy::with(['company', 'user', 'reports'])->findOrFail($id);

        return view('vacancies.show', compact('vacancy'));
    }
}
