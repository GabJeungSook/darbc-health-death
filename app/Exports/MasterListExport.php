<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\CashAdvance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MasterListExport implements FromView
{
    public function view(): View
    {
        return view('exports.masterlist', [
            'cashAdvance' => CashAdvance::get(),
        ]);
    }
}
