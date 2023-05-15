<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Member;
use App\Models\ReportHeader;
use Livewire\WithPagination;
use App\Models\CashAdvance;


class CashAdvanceReport extends Component
{
    use WithPagination;
    public $report_get;
    public $date_from;
    public $date_to;
    public $status;

    public function redirectToCashAdvance()
    {
        return redirect()->route('cash-advance');
    }

    public function render()
    {
        return view('livewire.cash-advance-report', [
            'cashAdvance' =>
            $this->report_get != 4 ? [] : CashAdvance::when($this->date_from && $this->date_to, function ($query) {
                $query->where(function ($query) {
                    $query->whereBetween('date_received', [$this->date_from, $this->date_to]);
                });
            })->paginate(100),
            'reports' => ReportHeader::where('report_id', 5)->get(),
            'first_report' => ReportHeader::where('report_id', 5)->where('report_name', 'Cash Advances')->first(),
        ]);
    }

    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 4:
                return \Excel::download(
                    new \App\Exports\MasterListExport(),
                    'CashAdvances.xlsx'
                );
                break;
            default:
                # code...
                break;
        }
    }
}
