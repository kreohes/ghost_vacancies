<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Support\ScamModel;
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

    public function text(Request $request)
    {
        $validated = $request->validate([
            'url' => ['required', 'url', 'max:255'],
            'text' => ['required', 'string', 'min:30', 'max:10000'],
        ]);

        return view('check', [
            'url' => $validated['url'],
            'text' => $validated['text'],
            'scamProbability' => ScamModel::probability($validated['text']),
            'scamWords' => ScamModel::topWords($validated['text']),
        ]);
    }
}
