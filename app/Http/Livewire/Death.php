<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use App\Models\Death as deathModel;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class Death extends Component  implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return deathModel::query();
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
            TextColumn::make('dependents_name')
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
            TextColumn::make('status')
                ->label('')
                ->searchable(),
            TextColumn::make('date_of_death')
                ->label('Date of Death')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('place_of_death')
                ->label('Place Of Death')
                ->searchable(),
            TextColumn::make('replacement')
                ->label('Replacement')
                ->searchable(),
            TextColumn::make('date_of_birth_m')
                ->label('Date Of Birth "M"')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('date_of_birth_r')
                ->label('Date Of Birth "R"')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('amount')
                ->label('Amount')
                ->searchable(),
            TextColumn::make('transmittal_status')
                ->label('Transmittal Status')
                ->searchable(),
            TextColumn::make('batches')
                ->label('Batches')
                ->searchable(),
            TextColumn::make('fortune_paid')
                ->label('Fortune Paid')
                ->searchable(),
            TextColumn::make('date_of_payment')
                ->date('F d, Y')
                ->label('Date Of Payment')
                ->searchable(),
            TextColumn::make('remarks')
                ->label('Status')
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
        ];
    }

    public function render()
    {
        return view('livewire.death');
    }
}
