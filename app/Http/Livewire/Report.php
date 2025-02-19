<?php

namespace App\Http\Livewire;

use App\Models\Death;
use App\Models\Health;
use App\Models\Member;
use Livewire\Component;
use App\Models\Signatory;
use App\Models\HealthDeath;
use App\Models\ReportHeader;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use App\Models\Report as ReportModel;

class Report extends Component
{
    use WithPagination;
    public $report_get;
    public $encoded_date;
    public $encoded_date_from;
    public $encoded_date_to;
    public $date_from;
    public $date_to;
    public $status = [];
    public $transmitted_date;
    public $transmittal_date_from;
    public $transmittal_date_to;
    public $transmittal_status = [];
    protected $health;
    protected $transmittal;
    public $enrollment_status = [];



    public function updatedReportGet()
    {
        $this->enrollment_status = [];
    }

    public function render()
    {
        // $this->health = Health::when($this->date_from && $this->date_to, function ($query) {
        //     $query->where(function ($query) {
        //         $query->when($this->date_from === $this->date_to, function ($query) {
        //             $query->whereDate('confinement_date_from', $this->date_from);
        //         }, function ($query) {
        //             $query->whereBetween('confinement_date_from', [$this->date_from, $this->date_to])
        //                 ->whereBetween('confinement_date_to', [$this->date_from, $this->date_to]);
        //         });
        //     });
        // })
        // ->when($this->encoded_date_from && $this->encoded_date_to, function ($query) {
        //     $query->where(function ($query) {
        //         $query->when($this->encoded_date_from === $this->encoded_date_to, function ($query) {
        //             $query->whereDate('created_at', $this->encoded_date_from);
        //         }, function ($query) {
        //             $query->whereBetween('created_at', [$this->encoded_date_from, $this->encoded_date_to]);
        //         });
        //     });
        // })
        // ->when(!empty($this->status), function ($query) {
        //     $query->whereIn('status', (array)$this->status);
        // })
        // ->when(!empty($this->enrollment_status), function ($query) {
        //     $query->where('enrollment_status', $this->enrollment_status);
        // })
        // ->paginate(100);


        $this->health = Health::when($this->date_from && $this->date_to, function ($query) {
            $query->where(function ($query) {
                if($this->date_from === $this->date_to)
                {
                    $query->whereDate('confinement_date_from', $this->date_from);
                }else{
                    $query->whereBetween('confinement_date_from', [$this->date_from, $this->date_to])
                    ->whereBetween('confinement_date_to', [$this->date_from, $this->date_to]);
                }

            });
        })
        ->when($this->encoded_date_from && $this->encoded_date_to, function ($query) {
            $query->where(function ($query) {
                if($this->encoded_date_from === $this->encoded_date_to)
                {
                    $query->whereDate('created_at', $this->encoded_date_from);
                }else{
                    $query->whereRaw("DATE(created_at) BETWEEN ? AND ?", [
                        $this->encoded_date_from,
                        $this->encoded_date_to
                    ]);
                }

            });
        })
        ->when(!empty($this->status), function ($query) {
            if (is_array($this->status)) {
                $query->whereIn('status', $this->status);
            } else {
                $query->where('status', $this->status);
            }
        })
        ->when(!empty($this->enrollment_status), function ($query) {
                $query->where('enrollment_status', $this->enrollment_status);
        })
        ->paginate(100);

        // Fetch additional data from API
        $this->health->getCollection()->transform(function ($item) {
            $url = 'https://darbcmembership.org/api/member-information/'.$item->member_id;
            $response = Http::withOptions(['verify' => false])->get($url);
            $member_data = $response->json();
            if ($member_data != null) {
                $data = $member_data->json();
                $item->darbc_id = $data['darbc_id'] ?? null;
                $item->first_name = $data['user']['first_name'] ?? null;
            } else {
                $item->darbc_id = null;
                $item->first_name = null;
            }

            return $item;
        });

        return view('livewire.report', [
            'healths' =>
                $this->report_get != 1 ? [] : ($this->health == null ? [] : $this->health),
            'transmittals' =>
                    $this->report_get != 2
                        ? []
                        : Health::whereHas('transmittals', function ($query) {
                            if($this->transmitted_date != null)
                            {
                                $query->whereDate('date_transmitted', $this->transmitted_date);
                            }else{
                                $query->whereNotNull('date_transmitted');
                            }
                        })->where('status', 'TRANSMITTED')->when($this->transmittal_date_from && $this->transmittal_date_to, function ($query) {
                            $query->where(function ($query) {
                                $query->whereBetween('confinement_date_from', [$this->transmittal_date_from, $this->transmittal_date_to])
                                      ->whereBetween('confinement_date_to', [$this->transmittal_date_from, $this->transmittal_date_to]);
                            });
                        })
                        // ->when($this->encoded_date, function ($query) {
                        //     $query->whereDate('created_at', $this->encoded_date);
                        // })
                        ->when(!empty($this->transmittal_status), function ($query) {
                            if (is_array($this->transmittal_status)) {
                                $query->whereIn('status', $this->transmittal_status);
                            } else {
                                $query->where('status', $this->transmittal_status);
                            }
                        })
                        ->when(!empty($this->enrollment_status), function ($query) {
                            $query->where('enrollment_status', $this->enrollment_status);
                        })
                        ->paginate(100),
        'in_house' =>
                        $this->report_get != 29
                            ? []
                            : Health::whereHas('in_houses')->where('status', 'IN-HOUSE')->when($this->transmittal_date_from && $this->transmittal_date_to, function ($query) {
                                $query->where(function ($query) {
                                    $query->whereBetween('confinement_date_from', [$this->transmittal_date_from, $this->transmittal_date_to])
                                          ->whereBetween('confinement_date_to', [$this->transmittal_date_from, $this->transmittal_date_to]);
                                });
                            })
                            ->when($this->encoded_date_from && $this->encoded_date_to, function ($query) {
                                $query->where(function ($query) {
                                    if($this->encoded_date_from === $this->encoded_date_to)
                                    {
                                        $query->whereDate('created_at', $this->encoded_date_from);
                                    }else{
                                        $query->whereRaw("DATE(created_at) BETWEEN ? AND ?", [
                                            $this->encoded_date_from,
                                            $this->encoded_date_to
                                        ]);
                                    }

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
                        ->when($this->encoded_date_from && $this->encoded_date_to, function ($query) {
                            $query->where(function ($query) {
                                if($this->encoded_date_from === $this->encoded_date_to)
                                {
                                    $query->whereDate('created_at', $this->encoded_date_from);
                                }else{
                                    $query->whereRaw("DATE(created_at) BETWEEN ? AND ?", [
                                        $this->encoded_date_from,
                                        $this->encoded_date_to
                                    ]);
                                }

                            });
                        })
                        ->when(!empty($this->transmittal_status), function ($query) {
                            if (is_array($this->transmittal_status)) {
                                $query->whereIn('status', $this->transmittal_status);
                            } else {
                                $query->where('status', $this->transmittal_status);
                             }
                        })
                        ->when(!empty($this->enrollment_status), function ($query) {
                            $query->where('enrollment_status', $this->enrollment_status);
                        })
                        ->paginate(100),
            'encoded' =>
                    $this->report_get != 8
                        ? []
                        : Health::whereDoesntHave('transmittals')->where('status', 'ENCODED')->when($this->transmittal_date_from && $this->transmittal_date_to, function ($query) {
                            $query->where(function ($query) {
                                $query->whereBetween('confinement_date_from', [$this->transmittal_date_from, $this->transmittal_date_to])
                                        ->whereBetween('confinement_date_to', [$this->transmittal_date_from, $this->transmittal_date_to]);
                            });
                        })
                        ->when($this->encoded_date_from && $this->encoded_date_to, function ($query) {
                            $query->where(function ($query) {
                                if($this->encoded_date_from === $this->encoded_date_to)
                                {
                                    $query->whereDate('created_at', $this->encoded_date_from);
                                }else {
                                    $query->whereRaw("DATE(created_at) BETWEEN ? AND ?", [
                                        $this->encoded_date_from,
                                        $this->encoded_date_to
                                    ]);
                                }
                            });
                        })
                        ->when(!empty($this->transmittal_status), function ($query) {
                            if (is_array($this->transmittal_status)) {
                                $query->whereIn('status', $this->transmittal_status);
                            } else {
                                $query->where('status', $this->transmittal_status);
                             }
                        })
                        // ->when(!empty($this->enrollment_status), function ($query) {
                        //     $query->where('enrollment_status', $this->enrollment_status);
                        // })
                        ->paginate(100),
            'below' =>
                    $this->report_get != 9
                        ? []
                        : Health::where('amount', '<', 10000)->paginate(100),
            'above' =>
                    $this->report_get != 28
                        ? []
                        : Health::where('amount', '>', 10000)->paginate(100),
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
            'sixth_signatories' => Signatory::where('report_header_id', 9)->get(),
            'seventh_report' => ReportHeader::where('report_id', 1)->where('report_name', 'Above 10k')->first(),
            'seventh_signatories' => Signatory::where('report_header_id', 28)->get(),
            'eighth_report' => ReportHeader::where('report_id', 1)->where('report_name', 'In-House')->first(),
            'eighth_signatories' => Signatory::where('report_header_id', 29)->get(),
            'total' => Health::where('amount', '<', 10000)->sum('amount'),
            'total_above' => Health::where('amount', '>', 10000)->sum('amount'),
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
                    new \App\Exports\HealthExport($this->encoded_date_from, $this->encoded_date_to, $this->date_from, $this->date_to, $this->status, $this->enrollment_status),
                    'health-MembersAndDependent.xlsx');

                break;

            case 2:
                return \Excel::download(
                    new \App\Exports\TransmittalExport($this->transmitted_date, $this->transmittal_date_from, $this->transmittal_date_to, $this->transmittal_status, $this->enrollment_status),
                    'Transmittals.xlsx');
                // return \Excel::download(
                //     new \App\Exports\TransmittalExport(),
                //     'Transmittals.xlsx'
                // );
                break;
            case 7:
                return \Excel::download(
                    new \App\Exports\PaymentExport($this->encoded_date_from, $this->encoded_date_to, $this->transmittal_date_from, $this->transmittal_date_to, $this->transmittal_status),
                    'Payments.xlsx');
                // return \Excel::download(
                //     new \App\Exports\PaymentExport(),
                //     'Payments.xlsx'
                // );
                break;
            case 8:
                return \Excel::download(
                    new \App\Exports\EncodedExport($this->encoded_date_from, $this->encoded_date_to, $this->transmittal_date_from, $this->transmittal_date_to, $this->transmittal_status, $this->enrollment_status),
                    'Encoded.xlsx');
                // return \Excel::download(
                //     new \App\Exports\EncodedExport(),
                //     'Encoded.xlsx'
                // );
                break;
            case 9:
                return \Excel::download(
                    new \App\Exports\BelowTenExport(),
                    'Below10K.xlsx'
                );
                break;
            case 28:
                return \Excel::download(
                    new \App\Exports\AboveTenExportExport(),
                    'Above10K.xlsx'
                );
                break;
            case 29:
                return \Excel::download(
                    new \App\Exports\InHouseExport($this->encoded_date_from, $this->encoded_date_to, $this->transmittal_date_from, $this->transmittal_date_to, $this->transmittal_status),
                    'In-House.xlsx');
                break;
            default:
                # code...
                break;
        }
    }
}
