<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $reports = auth()->user()->reports()->with('vacancy.company')->latest()->get();

        return view('userzone.reports.index', compact('reports'));
    }
}
