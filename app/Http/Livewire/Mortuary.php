<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use App\Models\Mortuary as MortuaryModel;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use WireUi\Traits\Actions;
use DB;

class Mortuary extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $addMortuary = false;
    protected $listeners = ['close_mortuary_modal'=> 'closeModal'];

    protected function getTableQuery(): Builder
    {
        return MortuaryModel::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('memberName')
            ->label('Member Name')
            ->formatStateUsing(function ($record) {
                $url = 'https://darbc.org/api/member-information/'.$record->member_id;
                $response = file_get_contents($url);
                $member_data = json_decode($response, true);

                $collection = collect($member_data['data']);

                return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']);
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('claimantName')
            ->label('Claimants Name')
            ->formatStateUsing(function ($record) {
                  return strtoupper($record->claimants_last_name) . ', ' . strtoupper($record->claimants_first_name) . ' ' . strtoupper($record->claimants_middle_name) ;
            })
            ->searchable()
            ->sortable(),
            BadgeColumn::make('status')
            ->enum([
                'Approved' => 'Approved',
                'Pending' => 'Pending',
            ])
            ->colors([
                'success' => 'Approved',
                'warning' => 'Pending',
            ]),
            BadgeColumn::make('diamond_package')
            ->enum([
                'Yes' => 'Yes',
                'No' => 'No',
                'Islam' => 'Islam',
                'Distant' => 'Distant',
            ])
            ->colors([
                'success' => 'Yes',
                'danger' => 'No',
                'primary' => 'Islam',
                'secondary' => 'Distant'
            ]),
            BadgeColumn::make('vehicle')
            ->enum([
                'Yes' => 'Yes',
                'No' => 'No',
            ])
            ->colors([
                'success' => 'Yes',
                'danger' => 'No',
            ])
        ];
    }

    public function closeModal()
    {
        $this->addMortuary = false;
    }

    public function redirectToInquiry()
    {
        return redirect()->route('mortuary-inquiry');
    }

    public function redirectToReport()
    {
        return redirect()->route('mortuary-report');
    }


    public function render()
    {
        return view('livewire.mortuary');
    }
}
