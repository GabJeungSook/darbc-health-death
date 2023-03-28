<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use App\Models\HealthDeath;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class HealthDeathInquiry extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return HealthDeath::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('member_id')
                ->label('Member ID')
                ->searchable(),
            TextColumn::make('memberName')
                ->formatStateUsing(function ($record) {
                    return $record->members->name;
                })
                ->label('Member Name')
                ->searchable(),
            TextColumn::make('batch')
                ->label('Batch')
                ->searchable(),
            TextColumn::make('date')
                ->label('Date')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('patients_name')
                ->label('Patient\'s Name')
                ->searchable(),
            TextColumn::make('contact_number')
                ->label('Contact Number')
                ->searchable(),
            TextColumn::make('age')
                ->label('Age')
                ->searchable(),
            TextColumn::make('enrollment_status')
                ->label('Enrollment Status')
                ->searchable(),
            TextColumn::make('dhib')
                ->label('')
                ->searchable(),
            TextColumn::make('date_of_confinement_from')
                ->label('Date of Confinement From')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('date_of_confinement_to')
                ->label('Date of Confinement To')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('hospital_name')
                ->label('Hospital')
                ->searchable(),
            TextColumn::make('number_of_days')
                ->label('Number Of Days')
                ->searchable(),
            TextColumn::make('amount')
                ->label('Amount')
                ->searchable(),
            TextColumn::make('transmittal_status')
                ->label('Transmittal Status')
                ->searchable(),
            TextColumn::make('fortune_paid')
                ->label('Fortune Paid')
                ->searchable(),
            TextColumn::make('date_of_payment')
                ->label('Date Of Payment')
                ->searchable(),
            TextColumn::make('status')
                ->label('Remarks/Status')
                ->searchable(),
            TextColumn::make('difference')
                ->label('Difference')
                ->searchable(),
            TextColumn::make('_batches')
                ->label('Batches')
                ->searchable(),
            TextColumn::make('with_hollographic_will')
                ->label('With Hollographic Will')
                ->searchable(),
            TextColumn::make('vehicle_cash')
                ->label('Vehicle Cash')
                ->searchable(),
            TextColumn::make('vehicle')
                ->label('Vehicle')
                ->searchable(),
            TextColumn::make('cannery')
                ->label('Cannery')
                ->searchable(),
            TextColumn::make('polomolok')
                ->label('Polomolok')
                ->searchable(),
        ];
    }

    public function render()
    {
        return view('livewire.health-death-inquiry');
    }
}
