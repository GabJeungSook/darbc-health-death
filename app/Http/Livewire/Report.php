<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Health;
use App\Models\Member;
use Livewire\WithPagination;
use App\Models\Death;
use App\Models\Report as ReportModel;
use App\Models\ReportHeader;
class Report extends Component
{
    use WithPagination;
    public $report_get;
    public $date_from;
    public $date_to;
    public $status = [];
    public $transmittal_date_from;
    public $transmittal_date_to;
    public $transmittal_status = [];
    protected $health;
    protected $transmittal;

    public function render()
    {

        $this->health = Health::when($this->date_from && $this->date_to, function ($query) {
            $query->where(function ($query) {
                $query->whereBetween('confinement_date_from', [$this->date_from, $this->date_to])
                      ->whereBetween('confinement_date_to', [$this->date_from, $this->date_to]);
            });
        })
        ->when(!empty($this->status), function ($query) {
            if (is_array($this->status)) {
                $query->whereIn('status', $this->status);
            } else {
                $query->where('status', $this->status);
            }
        })
        ->paginate(100);

        return view('livewire.report', [
            'healths' =>
                $this->report_get != 1 ? [] : ($this->health == null ? [] : $this->health),
            'transmittals' =>
                    $this->report_get != 2
                        ? []
                        : Health::whereHas('transmittals')->when($this->transmittal_date_from && $this->transmittal_date_to, function ($query) {
                            $query->where(function ($query) {
                                $query->whereBetween('confinement_date_from', [$this->transmittal_date_from, $this->transmittal_date_to])
                                      ->whereBetween('confinement_date_to', [$this->transmittal_date_from, $this->transmittal_date_to]);
                            });
                        })
                        ->when(!empty($this->transmittal_status), function ($query) {
                            if (is_array($this->transmittal_status)) {
                                $query->whereIn('status', $this->transmittal_status);
                            } else {
                                $query->where('status', $this->transmittal_status);
                            }
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
            'reports' => ReportHeader::where('report_id', 1)->get(),
            'first_report' => ReportHeader::where('report_id', 1)->where('report_name', 'Health - Members & Dependent')->first(),
            'second_report' => ReportHeader::where('report_id', 1)->where('report_name', 'Transmittals')->first(),
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
                    new \App\Exports\TransmittalExport(),
                    'Transmittals.xlsx'
                );
                break;

            default:
                # code...
                break;
        }
    }
}
