<?php

namespace App\Exports;

use App\Models\Health;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BelowTenExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.below', [
            'below' => Health::where('amount', '<', 10000)->get(),
            'total' => Health::where('amount', '<', 10000)->sum('amount'),
        ]);
    }
}
