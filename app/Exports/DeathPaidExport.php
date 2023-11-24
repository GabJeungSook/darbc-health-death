<?php

namespace App\Exports;

use App\Models\Death;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DeathPaidExport implements FromView
{
    public $encoded_date;
    public $date_from;
    public $date_to;
    public $status;
    public $vehicle;
    public $diamond_package;
    public $coverage_type;
    public $death;
    public $enrollment_status;

    public function __construct($encoded_date, $date_from, $date_to, $vehicle,$diamond_package, $coverage_type, $enrollment_status)
    {
        $this->encoded_date = $encoded_date;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->vehicle = $vehicle;
        $this->diamond_package = $diamond_package;
        $this->date_to = $date_to;
        $this->coverage_type = $coverage_type;
        $this->enrollment_status = $enrollment_status;

        $this->death = Death::whereHas('payments')->where('status', 'PAID')->when($this->date_from && $this->date_to, function ($query) {
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
        ->get();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.death-paid', [
            'payments' => $this->death,
        ]);
    }
}
