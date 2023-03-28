<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\HealthDeath;
use Filament\Tables\Columns\TextColumn;

class Masterlist extends Component implements Tables\Contracts\HasTable
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
                ->label('MEMBER ID')
                ->searchable()
                ->sortable(),
            TextColumn::make('batch')
                ->label('BATCH')
                ->searchable()
                ->sortable(),
            TextColumn::make('date')
                ->date('F d, Y')
                ->label('DATE')
                ->searchable()
                ->sortable(),
            TextColumn::make('patients_name')
                ->label('PATIENT NAME')
                ->searchable()
                ->sortable(),
            TextColumn::make('contact_number')
                ->label('CONTACT NUMBER')
                ->searchable()
                ->sortable(),
            TextColumn::make('age')
                ->label('AGE')
                ->searchable()
                ->sortable(),
            TextColumn::make('enrollment_status')
                ->label('ENROLLMENT STATUS')
                ->searchable()
                ->sortable(),
            TextColumn::make('dhib')
                ->label('DHIB')
                ->searchable()
                ->sortable(),
            TextColumn::make('date_of_confinement_from')
                ->label('DATE OF CONFINEMENT FROM')
                ->date('F d, Y')
                ->searchable()
                ->sortable(),
            TextColumn::make('date_of_confinement_to')
                ->label('DATE OF CONFINEMENT TO')
                ->searchable()
                ->date('F d, Y')
                ->sortable(),
            TextColumn::make('hospital_name')
                ->label('HOSPITAL NAME')
                ->searchable()
                ->sortable(),
            TextColumn::make('number_of_days')
                ->label('NUMBER OF DAYS')
                ->searchable()
                ->sortable(),
            TextColumn::make('amount')
                ->label('AMOUNT')
                ->searchable()
                ->sortable(),
            TextColumn::make('transmittal_status')
                ->label('TRANSMITTAL STATUS')
                ->searchable()
                ->sortable(),
            TextColumn::make('batches')
                ->label('BATCHES')
                ->searchable()
                ->sortable(),
            TextColumn::make('transmittal_date')
                ->label('TRANSMITTAL DATE')
                ->date('F d, Y')
                ->searchable()
                ->sortable(),
            TextColumn::make('fortune_paid')
                ->label('FORTUNE PAID')
                ->searchable()
                ->sortable(),
            TextColumn::make('date_of_payment')
                ->label('DATE OF PAYMENT')
                ->date('F d, Y')
                ->searchable()
                ->sortable(),
            TextColumn::make('status')
                ->label('STATUS')
                ->searchable()
                ->sortable(),
            TextColumn::make('difference')
                ->label('DIFFERENCE')
                ->searchable()
                ->sortable(),
            TextColumn::make('_batch')
                ->label('_BATCH')
                ->searchable()
                ->sortable(),
            TextColumn::make('with_hollogrophic_will')
                ->label('HOLOGRAPHIC WILL')
                ->searchable()
                ->sortable(),
            TextColumn::make('vehicle_cash')
                ->label('VEHICLE CASH')
                ->searchable()
                ->sortable(),
            TextColumn::make('vehicle')
                ->label('VEHICLE')
                ->searchable()
                ->sortable(),
            TextColumn::make('cannery')
                ->label('CANNERY')
                ->searchable()
                ->sortable(),
            TextColumn::make('polomolok')
                ->label('POLOMOLOK')
                ->searchable()
                ->sortable(),
        ];
    }

    public function render()
    {
        return view('livewire.masterlist');
    }
}
