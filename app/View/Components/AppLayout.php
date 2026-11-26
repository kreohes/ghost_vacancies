<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public array $menu = [];

    public function __construct()
    {
        $this->menu = [
            'Vacancies' => route('vacancies.index'),
            'Companies' => route('companies.index'),
            'About' => route('about'),
            'Risk' => route('risk'),
        ];
    }

    public function render(): View
    {
        return view('layouts.app');
    }
}
