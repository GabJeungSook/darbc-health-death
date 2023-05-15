<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\CashAdvance;

class ViewCashAdvanceData extends Component
{
    public $record;
    public function render()
    {
        return view('livewire.forms.view-cash-advance-data');
    }
}
