<?php

namespace App\Exports;

use App\Models\HealthDeath;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HealthExport implements FromView
{
    public function view(): View
    {
        return view('exports.health', [
            'healths' => HealthDeath::get(),
        ]);
    }
}
