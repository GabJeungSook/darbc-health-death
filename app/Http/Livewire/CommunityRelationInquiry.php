<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use App\Models\CommunityRelation;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class CommunityRelationInquiry extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public $filters = [
        'reference_number' => null,
        'first_name' => null,
        'middle_name' => null,
        'last_name' => null,
        'organization' => null,
        'contact_number' => null,
        'purpose' => null,
        'type' => null,
        'number_of_participants' => null,
        'status' => null,
    ];

    public $search = '';

    protected function getTableQuery(): Builder
    {
        return CommunityRelation::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('reference_number')
            ->label('Ref. No.')
            ->searchable()
            ->sortable(),
            TextColumn::make('memberName')
            ->label('Name')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) . ' ' . strtoupper($record->last_name) ;
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('organization')
            ->label('Organization / Address')
            ->searchable()
            ->sortable(),
            TextColumn::make('contact_number')
            ->label('Contact Number')
            ->searchable()
            ->sortable(),
            TextColumn::make('community_purpose.name')
            ->label('Purpose')
            ->searchable()
            ->sortable(),
            TextColumn::make('community_type.name')
            ->label('Type')
            ->searchable()
            ->sortable(),
            TextColumn::make('number_of_participants')
            ->label('Participants')
            ->searchable()
            ->sortable(),
            TextColumn::make('status')
            ->label('Status')
            ->searchable()
            ->sortable(),
        ];
    }

    public function redirectToCommunityRelation()
    {
        return redirect()->route('community-relations');
    }

    public function render()
    {
        return view('livewire.community-relation-inquiry', [
            'records' => CommunityRelation::with('community_purpose')
            ->get()
        ]);
    }
}
