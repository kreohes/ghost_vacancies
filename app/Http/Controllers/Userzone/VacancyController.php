<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = auth()->user()->vacancies()->with(['company', 'reports'])->latest()->get();

        return view('userzone.vacancies.index', compact('vacancies'));
    }

    public function create(Request $request)
    {
        return view('userzone.vacancies.create', [
            'companies' => Company::orderBy('name')->pluck('name', 'id'),
            'selectedCompanyId' => $request->query('company_id'),
            'url' => $request->query('url'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Vacancy::validationRules());

        $vacancy = auth()->user()->vacancies()->create($validated);

        return redirect()->route('vacancies.show', $vacancy);
    }

    public function edit($id)
    {
        $vacancy = auth()->user()->vacancies()->findOrFail($id);

        return view('userzone.vacancies.edit', [
            'vacancy' => $vacancy,
            'companies' => Company::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $vacancy = auth()->user()->vacancies()->findOrFail($id);

        $validated = $request->validate(Vacancy::validationRules());

        $vacancy->update($validated);

        return redirect()->route('vacancies.show', $vacancy);
    }

    public function destroy($id)
    {
        $vacancy = auth()->user()->vacancies()->findOrFail($id);

        $vacancy->delete();

        return redirect()->route('userzone.vacancies.index');
    }
}
