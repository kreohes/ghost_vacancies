<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('reports')->withCount('vacancies')->orderBy('name')->get();

        return view('companies.index', compact('companies'));
    }

    public function show($id)
    {
        $company = Company::with(['vacancies.company', 'vacancies.reports', 'reports'])->findOrFail($id);

        return view('companies.show', compact('company'));
    }
}
