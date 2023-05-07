<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use App\Models\Death;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class DeathInquiry extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    public $filters = [
        'member_id' => null,
        'batch_number' => null,
        'date' => null,
        'enrollment_status' => null,
        'first_name' => null,
        'middle_name' => null,
        'last_name' => null,
        'dependents_first_name' => null,
        'dependents_middle_name' => null,
        'dependents_last_name' => null,
        'dependent_type' => null,
        'has_diamond_package' => null,
        'birthday' => null,
        'age' => null,
        'contact_number' => null,
        'date_of_death' => null,
        'place_of_death' => null,
        'coverage_type' => null,
        'has_vehicle' => null,
        'amount' => null,
    ];

    public $search = '';

    protected function getTableQuery(): Builder
    {
        return Death::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('member_id')
                ->label('DARBC ID')
                ->searchable(),
            // TextColumn::make('memberName')
            //     ->formatStateUsing(function ($record) {
            //         return $record->members->name;
            //     })
            //     ->label('Member Name')
            //     ->searchable(),
            TextColumn::make('batch_number')
                ->label('BATCH NUMBER')
                ->searchable(),
            TextColumn::make('date')
                ->label('DATE')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('enrollment_status')
                ->label('ENROLLMENT STATUS')
                ->searchable(),
            TextColumn::make('first_name')
                ->label('FIRST NAME')
                ->searchable(),
            TextColumn::make('middle_name')
                ->label('MIDDLE NAME')
                ->searchable(),
            TextColumn::make('last_name')
                ->label('LAST NAME')
                ->searchable(),
                TextColumn::make('dependents_first_name')
                ->label('DEPENDENT FIRST NAME')
                ->searchable(),
            TextColumn::make('dependents_middle_name')
                ->label('DEPENDENT MIDDLE NAME')
                ->searchable(),
            TextColumn::make('dependents_last_name')
                ->label('DEPENDENT LAST NAME')
                ->searchable(),
            TextColumn::make('dependents_type')
                ->label('DEPENDENT TYPE')
                ->searchable(),
            TextColumn::make('has_diamond_package')
                ->label('HAS DIAMOND PACKAGE')
                ->searchable(),
            TextColumn::make('birthday')
                ->label('BIRTHDAY')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('age')
                ->label('AGE')
                ->searchable(),
            TextColumn::make('contact_number')
                ->label('CONTACT NUMBER')
                ->searchable(),
            TextColumn::make('date_of_death')
                ->label('DATE OF DEATH')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('place_of_death')
                ->label('PLACE OF DEATH')
                ->searchable(),
            TextColumn::make('coverage_type')
                ->label('COVERAGE TYPE')
                ->searchable(),
            TextColumn::make('has_vehicle')
                ->label('HAS VEHICLE')
                ->searchable(),
            TextColumn::make('amount')
                ->label('AMOUNT')
                ->searchable(),
        ];
    }

    public function redirectToDeath()
    {
        return redirect()->route('death');
    }

    public function render()
    {
        return view('livewire.death-inquiry', [
            'records' => Death::where(
                'member_id',
                'like',
                '%' . $this->search . '%'
            )
            ->orWhere('batch_number', 'like', '%' . $this->search . '%')
            ->orWhere('enrollment_status', 'like', '%' . $this->search . '%')
            ->orWhere('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('middle_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orWhere('dependents_first_name', 'like', '%' . $this->search . '%')
            ->orWhere('dependents_middle_name', 'like', '%' . $this->search . '%')
            ->orWhere('dependents_last_name', 'like', '%' . $this->search . '%')
            ->orWhere('dependent_type', 'like', '%' . $this->search . '%')
            ->orWhere('birthday', 'like', '%' . $this->search . '%')
            ->orWhere('age', 'like', '%' . $this->search . '%')
            ->orWhere('contact_number', 'like', '%' . $this->search . '%')
            ->orWhere('place_of_death', 'like', '%' . $this->search . '%')
            ->orWhere('coverage_type', 'like', '%' . $this->search . '%')
            ->orWhere('amount', 'like', '%' . $this->search . '%')
            ->get()
        ]);
    }
}
