<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\CommunityRelation;

class ViewCommunityRelationData extends Component
{
    public $record;
    public function render()
    {
        return view('livewire.forms.view-community-relation-data');
    }
}
