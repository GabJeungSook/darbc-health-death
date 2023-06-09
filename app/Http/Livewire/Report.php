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
use App\Models\Signatory;
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
                        : Health::whereHas('transmittals')->where('status', 'TRANSMITTED')->when($this->transmittal_date_from && $this->transmittal_date_to, function ($query) {
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
            'payments' =>
                    $this->report_get != 7
                        ? []
                        : Health::whereHas('payments')->where('status', 'PAID')->when($this->transmittal_date_from && $this->transmittal_date_to, function ($query) {
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
            'encoded' =>
                    $this->report_get != 8
                        ? []
                        : Health::whereDoesntHave('transmittals')->where('status', 'ENCODED')->when($this->transmittal_date_from && $this->transmittal_date_to, function ($query) {
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
            'below' =>
                    $this->report_get != 10
                        ? []
                        : Health::where('amount', '<', 10000)->paginate(100),
            'reports' => ReportHeader::where('report_id', 1)->get(),
            'first_report' => ReportHeader::where('report_id', 1)->where('report_name', 'Health - Members & Dependent')->first(),
            'first_signatories' => Signatory::where('report_header_id', 1)->get(),
            'second_report' => ReportHeader::where('report_id', 1)->where('report_name', 'Transmittals')->first(),
            'second_signatories' => Signatory::where('report_header_id', 2)->get(),
            'third_report' => ReportHeader::where('report_id', 1)->where('report_name', 'Paid')->first(),
            'third_signatories' => Signatory::where('report_header_id', 7)->get(),
            'fourth_report' => ReportHeader::where('report_id', 1)->where('report_name', 'Encoded')->first(),
            'fourth_signatories' => Signatory::where('report_header_id', 8)->get(),
            'sixth_report' => ReportHeader::where('report_id', 1)->where('report_name', 'Below 10k')->first(),
            'sixth_signatories' => Signatory::where('report_header_id', 10)->get(),
            'total' => Health::where('amount', '<', 10000)->sum('amount'),
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
                return \Excel::download(
                    new \App\Exports\HealthExport(),
                    'health-MembersAndDependent.xlsx'
                );
                break;

            case 2:
                return \Excel::download(
                    new \App\Exports\TransmittalExport(),
                    'Transmittals.xlsx'
                );
                break;
            case 7:
                return \Excel::download(
                    new \App\Exports\PaymentExport(),
                    'Payments.xlsx'
                );
                break;
            case 8:
                return \Excel::download(
                    new \App\Exports\EncodedExport(),
                    'Encoded.xlsx'
                );
                break;
            case 10:
                return \Excel::download(
                    new \App\Exports\BelowTenExport(),
                    'Below10K.xlsx'
                );
                break;
            default:
                # code...
                break;
        }
    }
}
