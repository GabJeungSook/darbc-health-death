<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Member;
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
            $this->report_get != 2 ? [] : CashAdvance::paginate(100),
        ]);
    }

    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 1:
                break;

            case 2:
                return \Excel::download(
                    new \App\Exports\MasterListExport(),
                    'CashAdvances.xlsx'
                );
                break;

            case 5:
                return \Excel::download(
                    new \App\Exports\DeathExport(),
                    'Death-MembersAndDependent.xlsx'
                );
                break;
            case 3:
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
