<?php

namespace App\Exports;

use App\Models\Death;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DeathExport implements FromView
{
    public function view(): View
    {
        return view('exports.death', [
            'deaths' => Death::whereNotNull('date_of_death')->get(),
        ]);
    }
}
