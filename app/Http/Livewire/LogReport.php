<?php

namespace App\Http\Livewire;

use Excel;
use App\Models\Log;
use Livewire\Component;

class LogReport extends Component
{
    public $report_get;
    public $logs;
    public $date_from;
    public $date_to;
    public $encoded_date;
    public $enrollment_status_selected;

    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 1:
                return Excel::download(
                    new \App\Exports\LogsExport($this->encoded_date, $this->date_from, $this->date_to, $this->enrollment_status_selected),
                    'Letter-Of-Guarantee.xlsx');
                break;
            default:
                # code...
                break;
        }
    }

    public function render()
    {
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
        ->paginate(100);
        return view('livewire.log-report',[
        'logs' => $this->report_get != 1 ? [] : ($this->logs == null ? [] : Log::when($this->date_from && $this->date_to, function ($query) {
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
        ->paginate(100))]);
    }

    public function redirectToLog()
    {
        return redirect()->route('log');
    }
}
