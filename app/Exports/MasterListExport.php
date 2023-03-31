<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MasterListExport implements FromView
{
    public function view(): View
    {
        return view('exports.masterlist', [
            'members' => Member::whereHas('health_death', function ($query) {
                        $query->whereNotNull('number_of_days');
                    })->get(),
        ]);
    }
}
