<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = auth()->user()->vacancies()->with(['company', 'reports'])->latest()->get();

        return view('userzone.vacancies.index', compact('vacancies'));
    }
}
