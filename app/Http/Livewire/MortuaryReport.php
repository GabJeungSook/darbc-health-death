<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Member;
use App\Models\ReportHeader;
use Livewire\WithPagination;
use App\Models\Mortuary;
use App\Models\Signatory;

class MortuaryReport extends Component
{
    use WithPagination;
    public $report_get;
    public $encoded_date;
    public $date_from;
    public $date_to;
    public $status = [];
    public $vehicle = [];
    public $diamond_package = [];
    protected $mortuary;

    public function redirectToMortuary()
    {
        return redirect()->route('mortuary');
    }
    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 4:
                return \Excel::download(
                    new \App\Exports\MortuaryExport($this->encoded_date, $this->date_from, $this->date_to, $this->status, $this->vehicle, $this->diamond_package),
                    'Mortuaries.xlsx');
                // return \Excel::download(
                //     new \App\Exports\MortuaryExport(),
                //     'Mortuaries.xlsx'
                // );
                break;
            default:
                # code...
                break;
        }
    }

    public function render()
    {
        $this->mortuary = Mortuary::when($this->date_from && $this->date_to, function ($query) {
            $query->where(function ($query) {
                $query->whereBetween('created_at', [$this->date_from, $this->date_to]);
            });
        })
        ->when($this->encoded_date, function ($query) {
            $query->whereDate('created_at', $this->encoded_date);
        })
        ->when(!empty($this->status), function ($query) {
            if (is_array($this->status)) {
                $query->whereIn('status', $this->status);
            } else {
                $query->where('status', $this->status);
            }
        })
        ->when(!empty($this->vehicle), function ($query) {
            if (is_array($this->vehicle)) {
                $query->whereIn('vehicle', $this->vehicle);
            } else {
                $query->where('vehicle', $this->vehicle);
            }
        })
        ->when(!empty($this->diamond_package), function ($query) {
            if (is_array($this->diamond_package)) {
                $query->whereIn('diamond_package', $this->diamond_package);
            } else {
                $query->where('diamond_package', $this->diamond_package);
            }
        })
        ->paginate(100);

        return view('livewire.mortuary-report', [
            'mortuary' =>
            $this->report_get != 4 ? [] : ($this->mortuary == null ? [] : $this->mortuary),
            'reports' => ReportHeader::where('report_id', 4)->get(),
            'first_report' => ReportHeader::where('report_id', 4)->where('report_name', 'Mortuary Benefits')->first(),
            'first_signatories' => Signatory::where('report_header_id', 4)->get(),
        ]);
    }
}
