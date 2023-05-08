<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Health;
use App\Models\Member;
use Livewire\WithPagination;
use App\Models\Death;

class DeathReport extends Component
{
    use WithPagination;
    public $report_get;
    public $date_from;
    public $date_to;
    public $status;

    public function redirectToDeath()
    {
        return redirect()->route('death');
    }

    public function render()
    {
        return view('livewire.death-report', [
            'deaths' =>
            $this->report_get != 2 ? [] : Death::paginate(100),
        ]);
    }

    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 1:
                break;

            case 2:
                return \Excel::download(
                    new \App\Exports\DeathExport(),
                    'Death-MembersAndDependent.xlsx'
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
                    'MasterList.xlsx'
                );
                break;

            default:
                # code...
                break;
        }
    }
}
