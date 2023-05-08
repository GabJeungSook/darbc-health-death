<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Health;
use App\Models\Member;
use Livewire\WithPagination;
use App\Models\Death;
class Report extends Component
{
    use WithPagination;
    public $report_get;
    public $date_from;
    public $date_to;
    public $status;

    public function render()
    {
        // dd(
        //     \App\Models\HealthDeath::where('member_id', 21)
        //         ->whereMonth('date_of_confinement_to', 03)
        //         ->get()
        // );
        return view('livewire.report', [
            'healths' =>
                $this->report_get != 2 ? [] : Health::when($this->date_from && $this->date_to, function ($query) {
                    $query->where(function ($query) {
                        $query->whereBetween('confinement_date_from', [$this->date_from, $this->date_to])
                              ->orWhereBetween('confinement_date_to', [$this->date_from, $this->date_to]);
                    });
                })
                ->when($this->status, function ($query) {
                    $query->where('status', '=', $this->status);
                })
                ->paginate(100),
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
            'deaths' =>
                $this->report_get != 5
                    ? []
                    : Death::whereNotNull('date_of_death')->paginate(100),
        ]);
    }

    public function redirectToHealth()
    {
        return redirect()->route('health');
    }

    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 1:
                break;

            case 2:
                return \Excel::download(
                    new \App\Exports\HealthExport(),
                    'health-MembersAndDependent.xlsx'
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
