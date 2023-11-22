<?php

namespace App\Exports;

use App\Models\Health;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HealthExport implements FromView
{
    public $encoded_date;
    public $date_from;
    public $date_to;
    public $status;
    public $health;
    public $enrollment_status;

    public function __construct($encoded_date, $date_from, $date_to, $status, $enrollment_status)
    {
        $this->encoded_date = $encoded_date;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->status = $status;
        $this->enrollment_status = $enrollment_status;

        $this->health = Health::when($this->date_from && $this->date_to, function ($query) {
            $query->where(function ($query) {
                if($this->date_from === $this->date_to)
                {
                    $query->where('confinement_date_from', $this->date_from);
                }else{
                    $query->whereBetween('confinement_date_from', [$this->date_from, $this->date_to])
                    ->whereBetween('confinement_date_to', [$this->date_from, $this->date_to]);
                }

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
        ->when($this->enrollment_status, function ($query) {
            $query->where('enrollment_status', $this->enrollment_status);
        })
        ->paginate(100);
    }

    public function view(): View
    {
        return view('exports.health', [
            'healths' => $this->health
        ]);
    }
}
