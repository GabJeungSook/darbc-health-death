<?php

namespace App\Exports;

use App\Models\Mortuary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MortuaryExport implements FromView
{
    public $encoded_date;
    public $date_from;
    public $date_to;
    public $status;
    public $vehicle;
    public $diamond_package;
    public $mortuary;

    public function __construct($encoded_date, $date_from, $date_to, $status ,$vehicle, $diamond_package)
    {
        $this->encoded_date = $encoded_date;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->status = $status;
        $this->vehicle = $vehicle;
        $this->diamond_package = $diamond_package;

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
        ->get();
    }

    public function view(): View
    {
        return view('exports.mortuary', [
            'mortuary' => $this->mortuary,
        ]);
    }
}
