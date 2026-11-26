<?php

namespace App\Http\Controllers;

use App\Models\Report;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function risk()
    {
        return view('pages.risk', [
            'silenceAfterDays' => Report::SILENCE_AFTER_DAYS,
            'minReports' => Report::MIN_REPORTS_FOR_RISK,
        ]);
    }
}
