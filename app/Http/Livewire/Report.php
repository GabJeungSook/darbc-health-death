<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Member;

class Report extends Component
{
    public $report_get;
    public $date_from;
    public $date_to;
    public function render()
    {
        return view('livewire.report', [
            'healths' => HealthDeath::all(),
            'members' => Member::all(),
        ]);
    }

    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 1:
                # code...
                break;

            case 2:
                return \Excel::download(
                    new \App\Exports\HealthExport(),
                    'health-MembersAndDependent.xlsx'
                );
                break;

            default:
                # code...
                break;
        }
    }
}
