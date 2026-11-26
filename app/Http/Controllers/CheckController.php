<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function url(Request $request)
    {
        $validated = $request->validate([
            'url' => ['required', 'url', 'max:255'],
        ]);

        $vacancy = Vacancy::findByUrl($validated['url']);

        if ($vacancy) {
            return redirect()->route('vacancies.show', $vacancy)
                ->with('status', 'We know this vacancy. Here is what people reported.');
        }

        return view('check', ['url' => $validated['url']]);
    }
}
