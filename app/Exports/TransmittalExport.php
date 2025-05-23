<?php

namespace App\Exports;

use App\Models\Transmittal;
use App\Models\Health;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransmittalExport implements FromView
{
    public $encoded_date;
    public $transmittal_date_from;
    public $transmittal_date_to;
    public $transmittal_status;
    public $vehicle;
    public $diamond_package;
    public $coverage_type;
    public $transmitted;
    public $transmitted_date;
    public $enrollment_status;

    public function __construct($transmitted_date, $transmittal_date_from, $transmittal_date_to, $transmittal_status, $enrollment_status)
    {
        $this->transmitted_date = $transmitted_date;
        $this->transmittal_date_from = $transmittal_date_from;
        $this->transmittal_date_to = $transmittal_date_to;
        $this->transmittal_status = $transmittal_status;
        $this->enrollment_status = $enrollment_status;

        $this->transmitted = Health::when($this->transmitted_date, function ($query) {
            $query->whereHas('transmittals', function ($query) {
                $query->whereDate('date_transmitted', $this->transmitted_date);
            });
        }, function ($query) {
            // If no specific date is provided, just make sure transmittals exist
            $query->whereHas('transmittals');
        })
        ->where('status', 'TRANSMITTED')
        ->when($this->transmittal_date_from && $this->transmittal_date_to, function ($query) {
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
        })
        ->when($this->enrollment_status, function ($query) {
            $query->where('enrollment_status', $this->enrollment_status);
        })
        ->paginate(100);
    }

    public function view(): View
    {
        return view('exports.transmittal', [
            'transmittals' => $this->transmitted,
        ]);
    }
}
