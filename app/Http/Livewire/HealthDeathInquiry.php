<?php

namespace App\Http\Livewire;

use Filament\Tables;
use App\Models\Health;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class HealthDeathInquiry extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    public $filters = [
        'darbc_id' => null,
        'member' => null,
        'hospital' => null,
        'batch_number' => null,
        'enrollment_status' => null,
        'first_name' => null,
        'middle_name' => null,
        'last_name' => null,
        'contact_number' => null,
        'age' => null,
        'confinement_date_from' => null,
        'confinement_date_to' => null,
        'number_of_days' => null,
        'amount' => null,
    ];

    public $search = '';

    protected function getTableQuery(): Builder
    {
        return Health::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('member_id')
                ->label('DARBC ID')
                ->searchable(),
            TextColumn::make('memberName')
                ->formatStateUsing(function ($record) {
                    return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) .'.' ;
                })
                ->label('MEMBERS NAME')
                ->formatStateUsing(function ($record) {
                    $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                    $response = Http::withOptions(['verify' => false])->get($url);
                    $member_data = $response->json();

                    $collection = collect($member_data['data']);

                    return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) .'.' ;
                })->searchable(),
            TextColumn::make('hospitals.name')
                ->label('HOSPITAL')
                ->searchable(),
            TextColumn::make('batch_number')
                ->label('BATCH NUMBER')
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
            TextColumn::make('contact_number')
                ->label('CONTACT NUMBER')
                ->searchable(),
            TextColumn::make('age')
                ->label('AGE')
                ->searchable(),
            TextColumn::make('confinement_date_from')
                ->label('CONFINEMENT DATE FROM')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('confinement_date_to')
                ->label('CONFINEMENT DATE TO')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('number_of_days')
                ->label('NUMBER OF DAYS')
                ->searchable(),
            TextColumn::make('amount')
                ->label('AMOUNT')
                ->searchable(),
        ];
    }

    public function redirectToHealth()
    {
        return redirect()->route('health');
    }

    public function render()
    {
        return view('livewire.health-death-inquiry', [
            'records' => Health::where(
                'member_id',
                'like',
                '%' . $this->search . '%'
            )
            ->orWhere('batch_number', 'like', '%' . $this->search . '%')
            ->orWhere('enrollment_status', 'like', '%' . $this->search . '%')
            ->orWhere('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('middle_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orWhere('contact_number', 'like', '%' . $this->search . '%')
            ->orWhere('age', 'like', '%' . $this->search . '%')
            ->orWhere('number_of_days', 'like', '%' . $this->search . '%')
            ->orWhere('amount', 'like', '%' . $this->search . '%')
            ->get()
        ]);
    }
}
