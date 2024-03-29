<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Member;
use App\Models\ReportHeader;
use Livewire\WithPagination;
use App\Models\CashAdvance;
use App\Models\Signatory;
use Illuminate\Support\Facades\Http;


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
            $this->report_get != 5 ? [] : CashAdvance::when($this->date_from && $this->date_to, function ($query) {
                $query->where(function ($query) {
                    $query->whereBetween('date_received', [$this->date_from, $this->date_to]);
                });
            })->when($this->status, function ($query) {
                $query->where(function ($query) {
                    $query->where('status', $this->status);
                });
            })
            ->paginate(100),
            'reports' => ReportHeader::where('report_id', 5)->get(),
            'first_report' => ReportHeader::where('report_id', 5)->where('report_name', 'Cash Advances')->first(),
            'first_signatories' => Signatory::where('report_header_id', 5)->get(),
        ]);
    }

    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 5:
                return \Excel::download(
                    new \App\Exports\MasterListExport($this->date_from, $this->date_to, $this->status),
                    'CashAdvances.xlsx'
                );
                break;
            default:
                # code...
                break;
        }
    }
}
