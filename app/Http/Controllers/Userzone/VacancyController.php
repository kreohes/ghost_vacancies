<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Company;
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
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $vacancy = auth()->user()->vacancies()->create($validated);

        return redirect()->route('vacancies.show', $vacancy);
    }

    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'company_id' => ['required', 'exists:companies,id'],
            'url' => ['nullable', 'url', 'max:255'],
            'posted_at' => ['nullable', 'date', 'before_or_equal:today'],
        ];
    }
}
