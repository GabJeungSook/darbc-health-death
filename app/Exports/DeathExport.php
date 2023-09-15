<?php

namespace App\Exports;

use App\Models\Death;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DeathExport implements FromView
{
    public $encoded_date;
    public $date_from;
    public $date_to;
    public $status;
    public $vehicle;
    public $diamond_package;
    public $coverage;
    public $death;

    public function __construct($encoded_date, $date_from, $date_to, $vehicle,$diamond_package, $coverage)
    {
        $this->encoded_date = $encoded_date;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->vehicle = $vehicle;
        $this->diamond_package = $diamond_package;
        $this->date_to = $date_to;
        $this->coverage = $coverage;

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
        ->paginate(100);
    }


    public function view(): View
    {
        return view('exports.death', [
            'deaths' => $this->death,
        ]);
    }
}
