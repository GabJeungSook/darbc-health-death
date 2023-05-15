<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\ReportSignatory;

class ViewLog extends Component
{
    public $record;

    public function render()
    {
        return view('livewire.forms.view-log', [
            'record' => $this->record,
            'signatory' => ReportSignatory::where('report_id', 3)->first(),
        ]);
    }
}
