<?php

namespace App\Exports;

use App\Models\Transmittal;
use App\Models\Health;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransmittalExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.transmittal', [
            'transmittals' => Health::whereHas('transmittals')->get(),
        ]);
    }
}
