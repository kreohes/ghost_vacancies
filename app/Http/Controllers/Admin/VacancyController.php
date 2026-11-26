<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::with(['company', 'user'])->withCount('reports')->latest()->get();

        return view('admin.vacancies.index', compact('vacancies'));
    }

    public function edit($id)
    {
        return view('admin.vacancies.edit', [
            'vacancy' => Vacancy::findOrFail($id),
            'companies' => Company::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $validated = $request->validate(Vacancy::validationRules());

        $vacancy->update($validated);

        return redirect()->route('admin.vacancies.index');
    }

    public function destroy($id)
    {
        Vacancy::findOrFail($id)->delete();

        return redirect()->route('admin.vacancies.index');
    }
}
