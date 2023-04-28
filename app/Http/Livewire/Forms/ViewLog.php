<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

class ViewLog extends Component
{
    public $record;

    public function render()
    {
        return view('livewire.forms.view-log', [
            'record' => $this->record,
        ]);
    }
}
