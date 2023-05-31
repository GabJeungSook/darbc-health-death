<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Health;
use App\Models\Member;
use Livewire\WithPagination;
use App\Models\Death;
use App\Models\ReportHeader;
use App\Models\Signatory;

class DeathReport extends Component
{
    use WithPagination;
    public $report_get;
    public $date_from;
    public $date_to;
    public $vehicle = [];
    public $diamond_package = [];
    public $coverage_type = [];
    protected $death;

    public function redirectToDeath()
    {
        return redirect()->route('death');
    }

    public function render()
    {
        $this->death = Death::when($this->date_from && $this->date_to, function ($query) {
            $query->where(function ($query) {
                $query->whereBetween('date', [$this->date_from, $this->date_to]);
            });
        })
        ->when(!empty($this->vehicle), function ($query) {
            if (is_array($this->vehicle)) {
                $query->whereIn('has_vehicle', $this->vehicle);
            } else {
                $query->where('has_vehicle', $this->vehicle);
            }
        })
        ->when(!empty($this->diamond_package), function ($query) {
            if (is_array($this->diamond_package)) {
                $query->whereIn('has_diamond_package', $this->diamond_package);
            } else {
                $query->where('has_diamond_package', $this->diamond_package);
            }
        })
        ->when(!empty($this->coverage_type), function ($query) {
            if (is_array($this->coverage_type)) {
                $query->whereIn('coverage_type', $this->coverage_type);
            } else {
                $query->where('coverage_type', $this->coverage_type);
            }
        })
        ->paginate(100);

        return view('livewire.death-report', [
            'deaths' =>
            $this->report_get != 3 ? [] : ($this->death == null ? [] : $this->death),
            'reports' => ReportHeader::where('report_id', 2)->get(),
            'first_report' => ReportHeader::where('report_id', 2)->where('report_name', 'Death - Members & Dependent')->first(),
            'first_signatories' => Signatory::where('report_header_id', 3)->get(),
        ]);
    }

    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 3:
                return \Excel::download(
                    new \App\Exports\DeathExport(),
                    'Death-MembersAndDependent.xlsx'
                );
                break;
            default:
                # code...
                break;
        }
    }
}
