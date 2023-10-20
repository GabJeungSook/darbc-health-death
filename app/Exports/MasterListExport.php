<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\CashAdvance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MasterListExport implements FromView
{
     /**
    * @return \Illuminate\Support\Collection
    */
    public $date_from;
    public $date_to;
    public $status;
    public $cash_advance;
    public function __construct($date_from, $date_to, $status)
    {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->status = $status;

        $this->cash_advance = CashAdvance::when($this->date_from && $this->date_to, function ($query) {
            $query->where(function ($query) {
                $query->whereBetween('date_received', [$this->date_from, $this->date_to]);
            });
        })
        ->when($this->status, function ($query) {
            $query->where(function ($query) {
                $query->where('status', $this->status);
            });
        })
        ->get();
    }

    public function view(): View
    {
        return view('exports.masterlist', [
            'cashAdvance' => $this->cash_advance,
        ]);
    }
}
