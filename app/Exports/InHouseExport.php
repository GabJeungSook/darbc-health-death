<?php

namespace App\Exports;

use App\Models\Health;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InHouseExport implements FromView
{
    public $encoded_date;
    public $encoded_date_from;
    public $encoded_date_to;
    public $transmittal_date_from;
    public $transmittal_date_to;
    public $transmittal_status;
    public $vehicle;
    public $diamond_package;
    public $coverage_type;
    public $transmitted;

    public function __construct($encoded_date_from, $encoded_date_to, $transmittal_date_from, $transmittal_date_to, $transmittal_status)
    {
        $this->encoded_date_from = $encoded_date_from;
        $this->encoded_date_to = $encoded_date_to;
        $this->transmittal_date_from = $transmittal_date_from;
        $this->transmittal_date_to = $transmittal_date_to;
        $this->transmittal_status = $transmittal_status;

        $this->transmitted = Health::whereHas('in_houses')->where('status', 'IN-HOUSE')->when($this->transmittal_date_from && $this->transmittal_date_to, function ($query) {
            $query->where(function ($query) {
                $query->whereBetween('confinement_date_from', [$this->transmittal_date_from, $this->transmittal_date_to])
                      ->whereBetween('confinement_date_to', [$this->transmittal_date_from, $this->transmittal_date_to]);
            });
        })
        ->when($this->encoded_date_from && $this->encoded_date_to, function ($query) {
            $query->where(function ($query) {
                if($this->encoded_date_from === $this->encoded_date_to)
                {
                    $query->where('created_at', $this->encoded_date_from);
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
        })->paginate(100);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.in_house', [
            'in_houses' => $this->transmitted,
        ]);
    }
}
