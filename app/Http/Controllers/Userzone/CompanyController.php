<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        return view('userzone.companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255', 'unique:companies,name'],
            'website' => ['nullable', 'url', 'max:255'],
        ], [
            'name.unique' => 'This company already exists. Pick it from the list instead.',
        ]);

        $company = Company::create($validated);

        return redirect()->route('userzone.vacancies.create', ['company_id' => $company->id]);
    }
}
