<?php

namespace App\Exports;

use App\Models\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LogsExport implements FromView
{
    public $encoded_date;
    public $date_from;
    public $date_to;
    public $logs;
    public $enrollment_status_selected;

    public function __construct($encoded_date, $date_from, $date_to, $enrollment_status_selected)
    {
        $this->encoded_date = $encoded_date;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->enrollment_status_selected = $enrollment_status_selected;

        $this->logs = Log::when($this->date_from && $this->date_to, function ($query) {
            $query->where(function ($query) {
                $query->whereBetween('date_received', [$this->date_from, $this->date_to]);
            });
        })
        ->when($this->encoded_date, function ($query) {
            $query->whereDate('created_at', $this->encoded_date);
        })
        ->when($this->enrollment_status_selected, function ($query) {
            $query->where('enrollment_status', $this->enrollment_status_selected);
        })
        ->get();
    }

    public function view(): View
    {
        return view('exports.logs', [
            'logs' => $this->logs,
        ]);
    }
}
