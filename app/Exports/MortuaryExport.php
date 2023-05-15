<?php

namespace App\Exports;

use App\Models\Mortuary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MortuaryExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.mortuary', [
            'mortuary' => Mortuary::get(),
        ]);
    }
}
