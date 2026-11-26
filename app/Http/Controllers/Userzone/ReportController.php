<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function index()
    {
        $reports = auth()->user()->reports()->with('vacancy.company')->latest()->get();

        return view('userzone.reports.index', compact('reports'));
    }

    public function create(Request $request)
    {
        return view('userzone.reports.create', [
            'vacancies' => $this->vacancyOptions(),
            'selectedVacancyId' => $request->query('vacancy_id'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vacancy_id' => [
                'required',
                'exists:vacancies,id',
                Rule::unique('reports')->where('user_id', auth()->id()),
            ],
            'status' => ['required', Rule::in(Report::STATUSES)],
            'applied_at' => ['required', 'date', 'before_or_equal:today'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ], [
            'vacancy_id.unique' => 'You already reported this vacancy. Edit your existing report instead.',
        ]);

        auth()->user()->reports()->create($validated);

        return redirect()->route('userzone.reports.index');
    }

    private function vacancyOptions(): array
    {
        $options = [];

        foreach (Vacancy::with('company')->orderBy('title')->get() as $vacancy) {
            $options[$vacancy->id] = $vacancy->title.' at '.$vacancy->company->name;
        }

        return $options;
    }
}
