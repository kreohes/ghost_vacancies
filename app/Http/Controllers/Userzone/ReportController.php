<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Vacancy;
use App\Notifications\NewReportOnYourVacancy;
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

        $report = auth()->user()->reports()->create($validated);

        $author = $report->vacancy->user;
        if ($author->id !== auth()->id()) {
            $author->notify(new NewReportOnYourVacancy($report));
        }

        return redirect()->route('userzone.reports.index');
    }

    public function show($id)
    {
        $report = auth()->user()->reports()->findOrFail($id);

        return view('userzone.reports.show', compact('report'));
    }

    public function edit($id)
    {
        $report = auth()->user()->reports()->findOrFail($id);

        return view('userzone.reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = auth()->user()->reports()->findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', Rule::in(Report::STATUSES)],
            'applied_at' => ['required', 'date', 'before_or_equal:today'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $report->update($validated);

        return redirect()->route('userzone.reports.show', $report->id);
    }

    public function destroy($id)
    {
        $report = auth()->user()->reports()->findOrFail($id);

        $report->delete();

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
