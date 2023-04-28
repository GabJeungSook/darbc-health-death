<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms\Components;
use Filament\Tables\Actions\Position;
use App\Models\Member;
use Filament\Tables\Actions\ViewAction;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\HealthDeath;
use App\Models\Health;
use Filament\Tables\Columns\TextColumn;

class Masterlist extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public $addHealth = false;
    protected $listeners = ['close_modal'=> 'closeModal'];

    protected function getTableQuery(): Builder
    {
        return Health::query();
    }

    protected function getTableActionsPosition(): ?string
    {
        return Position::BeforeCells;
    }

    public function getTableActions()
    {
        return [
            ViewAction::make()
            ->label('View Data')
            ->modalHeading('Member Summary Data')
            ->color('success')
            ->modalWidth('6xl')
            ->modalContent(fn ($record) => view('livewire.forms.view-summary-data', [
                'record' => $record,
            ])),
        ];

    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('member_id')
                ->label('DARBC ID')
                ->searchable()
                ->sortable(),
            TextColumn::make('memberName')
                ->formatStateUsing(function ($record) {
                    return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) .'.' ;
                })
                ->label('MEMBERS NAME')
                ->searchable(query: function (Builder $query, string $search): Builder {
                return $query->whereHas('members', function($k) use ($search){
                    $k->where('name', 'like', "%{$search}%");
                });
                }),
            TextColumn::make('patientName')
                ->label('DEPENDENT')
                ->formatStateUsing(function ($record) {
                    return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) .'.' ;
                })
                ->searchable()
                ->sortable(),
            // TextColumn::make('contact_number')
            //     ->label('CONTACT NUMBER')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('age')
            //     ->label('AGE')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('enrollment_status')
            //     ->label('ENROLLMENT STATUS')
            //     ->formatStateUsing(function ($record) {
            //         if($record == 'member')
            //         {
            //             return 'M';
            //         }else{
            //             return 'D';
            //         }
            //     })
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('confinement_date_from')
            //     ->label('DATE OF CONFINEMENT FROM')
            //     ->date('F d, Y')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('confinement_date_to')
            //     ->label('DATE OF CONFINEMENT TO')
            //     ->searchable()
            //     ->date('F d, Y')
            //     ->sortable(),
            TextColumn::make('hospitals.name')
                ->label('HOSPITAL NAME')
                ->searchable()
                ->sortable(),
            // TextColumn::make('number_of_days')
            //     ->label('NUMBER OF DAYS')
            //     ->searchable()
            //     ->sortable(),
            TextColumn::make('amount')
                ->label('AMOUNT')
                ->searchable()
                ->sortable(),
            TextColumn::make('created_at')
                ->label('DATE PAID')
                ->searchable()
                ->sortable()
                ->date('F d, Y'),
            // TextColumn::make('transmittal_status')
            //     ->label('TRANSMITTAL STATUS')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('batches')
            //     ->label('BATCHES')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('transmittal_date')
            //     ->label('TRANSMITTAL DATE')
            //     ->date('F d, Y')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('fortune_paid')
            //     ->label('FORTUNE PAID')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('date_of_payment')
            //     ->label('DATE OF PAYMENT')
            //     ->date('F d, Y')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('status')
            //     ->label('STATUS')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('difference')
            //     ->label('DIFFERENCE')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('_batch')
            //     ->label('_BATCH')
            //     ->sortable(),
            // TextColumn::make('with_hollogrophic_will')
            //     ->label('HOLOGRAPHIC WILL')
            //     ->sortable(),
            // TextColumn::make('vehicle_cash')
            //     ->label('VEHICLE CASH')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('vehicle')
            //     ->label('VEHICLE')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('cannery')
            //     ->label('CANNERY')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('polomolok')
            //     ->label('POLOMOLOK')
            //     ->searchable()
            //     ->sortable(),
        ];
    }

    public function redirectToInquiry()
    {
        return redirect()->route('inquiry');
    }

    public function redirectToReport()
    {
        return redirect()->route('report');
    }

    public function redirectToHospital()
    {
        return redirect()->route('hospital');
    }


    public function closeModal()
    {
        $this->addHealth = false;
    }

    public function render()
    {
        return view('livewire.masterlist');
    }
}
