<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Member;
use Livewire\WithPagination;
class Report extends Component
{
    use WithPagination;
    public $report_get;
    public $date_from;
    public $date_to;
    public function render()
    {
        // dd(
        //     \App\Models\HealthDeath::where('member_id', 21)
        //         ->whereMonth('date_of_confinement_to', 03)
        //         ->get()
        // );
        return view('livewire.report', [
            'healths' =>
                $this->report_get != 2 ? [] : HealthDeath::paginate(100),
            'members' =>
                $this->report_get != 3
                    ? []
                    : Member::whereHas('health_death', function ($query) {
                        $query->whereNotNull('number_of_days');
                    })->paginate(100),
            'accountings' => HealthDeath::when($this->date_from, function (
                $query
            ) {
                $query->where('date_of_confinement_to', '=', $this->date_from);
            })->paginate(100),
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
