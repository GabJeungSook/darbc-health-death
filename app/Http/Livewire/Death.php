<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Actions\Position;
use Filament\Tables\Actions\ViewAction;
use App\Models\Death as deathModel;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class Death extends Component  implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public $addDeath = false;
    public $showRecord = false;
    public $showVehicleModal = false;
    protected $listeners = [
        'close_modal'=> 'closeModal',
        'show_vehicle_schedule' =>'showVehicleSchedule',
        'close_vehicle' =>'CloseVehicleSchedule'
    ];

    protected function getTableQuery(): Builder
    {
        return deathModel::query();
    }

    protected function getTableActionsPosition(): ?string
    {
        return Position::BeforeCells;
    }

    public function getTableActions()
    {
        return [
            // ViewAction::make()
            // ->label('View Data')
            // ->modalHeading('Death Summary Data')
            // ->color('success')
            // ->modalWidth('6xl')
            // ->modalContent(fn ($record) => view('livewire.forms.view-summary-data', [
            //     'record' => $record,
            // ])),
        ];

    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('date')
                ->label('Date')
                ->date('F d, Y')
                ->searchable(),
            // TextColumn::make('enrollment_status')
            //     ->label('Enrollment Status')
            //     ->searchable(),
            TextColumn::make('memberName')
                ->formatStateUsing(function ($record) {
                    $url = 'https://darbc.org/api/member-information/'.$record->member_id;
                    $response = file_get_contents($url);
                    $member_data = json_decode($response, true);

                    $collection = collect($member_data['data']);

                    return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) .'.' ;
                })
                ->label('Member Name')
                ->searchable(),
            TextColumn::make('dependents_name')
                ->label('Dependent\'s Name')
                ->formatStateUsing(function ($record) {
                    $url = 'https://darbc.org/api/member-information/'.$record->member_id;
                    $response = file_get_contents($url);
                    $member_data = json_decode($response, true);

                    $collection = collect($member_data['data']);
                    if($record->enrollment_status == 'member')
                    {
                        return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) .'.' ;
                    }else{
                        return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) .'.' ;
                    }
                })
                ->searchable(),
            IconColumn::make('has_diamond_package')
                ->boolean()
                ->label('Diamond Package'),
            TextColumn::make('date_of_death')
                ->label('Date of Death')
                ->date('F d, Y'),
            TextColumn::make('place_of_death')
                ->label('Place Of Death')
                ->searchable(),
            TextColumn::make('amount')
                ->label('Amount')
                ->searchable(),
        ];
    }

    public function closeModal()
    {
        $this->addDeath = false;
    }

    public function showVehicleSchedule()
    {
        $this->addDeath = false;
        $this->showVehicleModal = true;
    }

    public function CloseVehicleSchedule()
    {
        $this->showVehicleModal = false;
        $this->addDeath = true;
    }


    public function redirectToCalendar()
    {
        return redirect()->route('calendar');
    }

    public function redirectToInquiry()
    {
        return redirect()->route('death-inquiry');
    }

    public function render()
    {
        return view('livewire.death');
    }
}
