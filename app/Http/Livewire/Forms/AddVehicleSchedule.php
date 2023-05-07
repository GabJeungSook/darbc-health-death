<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Filament\Forms;
use App\Models\Member;
use App\Models\Death;
use App\Models\VehicleSchedule;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use DB;

class AddVehicleSchedule extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $date;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $scheduled_date;
    public $vehicle_type;
    public $remarks;

    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('date')->label('Date Requested')
            ->required(),
            Fieldset::make('Members Name')
            ->schema([
                Forms\Components\TextInput::make('first_name')->label('First Name')->reactive()->required(),
                Forms\Components\TextInput::make('middle_name')->label('Middle Name')->reactive(),
                Forms\Components\TextInput::make('last_name')->label('Last Name')->reactive()->required(),
            ])->columns(3),
            DatePicker::make('scheduled_date')->label('Scheduled Date')
            ->required(),
            Forms\Components\TextInput::make('vehicle_type')->label('Type Of Vehicle')->reactive()->required(),
            Forms\Components\TextInput::make('remarks')->label('Remarks')->reactive()->required(),
        ];
    }

    public function closeModal()
    {
        $this->emit('close_vehicle');
    }

    public function render()
    {
        return view('livewire.forms.add-vehicle-schedule');
    }
}
