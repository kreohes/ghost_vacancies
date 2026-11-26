<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['vacancy.company', 'user'])->latest()->get();

        return view('admin.reports.index', compact('reports'));
    }

    public function destroy($id)
    {
        Report::findOrFail($id)->delete();

        return redirect()->route('admin.reports.index');
    }
}
