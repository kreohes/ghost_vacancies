<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::withCount('vacancies')->orderBy('name')->get();

        return view('admin.companies.index', compact('companies'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255', Rule::unique('companies', 'name')->ignore($company->id)],
            'website' => ['nullable', 'url', 'max:255'],
        ]);

        $company->update($validated);

        return redirect()->route('admin.companies.index');
    }

    public function destroy($id)
    {
        Company::findOrFail($id)->delete();

        return redirect()->route('admin.companies.index');
    }
}
