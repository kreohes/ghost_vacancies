<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $user = auth()->user();

        return view('userzone.dashboard', [
            'reportCount' => $user->reports()->count(),
            'vacancyCount' => $user->vacancies()->count(),
            'waitingCount' => $user->reports()->where('status', 'silence')->count(),
        ]);
    }
}
