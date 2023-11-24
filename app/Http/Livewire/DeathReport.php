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
    public $encoded_date;
    public $transmitted_date;
    public $date_from;
    public $date_to;
    public $vehicle = [];
    public $diamond_package = [];
    public $coverage_type = [];
    public $enrollment_status;
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
        ->when($this->encoded_date, function ($query) {
            $query->whereDate('created_at', $this->encoded_date);
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
        ->when($this->enrollment_status, function ($query) {
            $query->where('enrollment_status', $this->enrollment_status);
        })
        ->paginate(100);

        return view('livewire.death-report', [
            'deaths' =>
            $this->report_get != 3 ? [] : ($this->death == null ? [] : $this->death),
            'transmittals' =>
            $this->report_get != 30
                ? []
                : Death::whereHas('transmittals', function ($query) {
                    if($this->transmitted_date != null)
                    {
                        $query->whereDate('date_transmitted', $this->transmitted_date);
                    }else{
                        $query->whereNotNull('date_transmitted');
                    }
                })->when($this->date_from && $this->date_to, function ($query) {
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
                ->when($this->enrollment_status, function ($query) {
                    $query->where('enrollment_status', $this->enrollment_status);
                })
                ->paginate(100),
            'payments' => Death::whereHas('payments')->where('status', 'PAID')->when($this->date_from && $this->date_to, function ($query) {
                $query->where(function ($query) {
                    $query->whereBetween('date', [$this->date_from, $this->date_to]);
                });
            })
            ->when($this->encoded_date, function ($query) {
                $query->whereDate('created_at', $this->encoded_date);
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
            ->when($this->enrollment_status, function ($query) {
                $query->where('enrollment_status', $this->enrollment_status);
            })
            ->paginate(100),
            'unpaid' => Death::where('status', 'UNPAID')->when($this->date_from && $this->date_to, function ($query) {
                $query->where(function ($query) {
                    $query->whereBetween('date', [$this->date_from, $this->date_to]);
                });
            })
            ->when($this->encoded_date, function ($query) {
                $query->whereDate('created_at', $this->encoded_date);
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
            ->when($this->enrollment_status, function ($query) {
                $query->where('enrollment_status', $this->enrollment_status);
            })
            ->paginate(100),
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
                    new \App\Exports\DeathExport($this->encoded_date, $this->date_from, $this->date_to, $this->vehicle, $this->diamond_package, $this->coverage_type),
                    'Death-MembersAndDependent.xlsx');
                // return \Excel::download(
                //     new \App\Exports\DeathExport(),
                //     'Death-MembersAndDependent.xlsx'
                // );
                break;
            default:
                # code...
                break;
        }
    }
}
