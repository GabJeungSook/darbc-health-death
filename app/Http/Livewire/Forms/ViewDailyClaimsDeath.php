<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

class ViewDailyClaimsDeath extends Component
{
    public $record;
    public function render()
    {
        return view('livewire.forms.view-daily-claims-death');
    }
}
