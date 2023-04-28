<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms\Components;
use Filament\Tables\Actions\Position;
use Closure;
use Filament\Tables\Actions\ViewAction;
use App\Models\Log as LogModel;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class Log extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public $addLog = false;
    protected $listeners = ['close_modal'=> 'closeModal'];

    protected function getTableQuery(): Builder
    {
        return LogModel::query();
    }

    protected function getTableActionsPosition(): ?string
    {
        return Position::BeforeCells;
    }

    public function getTableActions()
    {
        return [
            ViewAction::make()
            ->label('View Log')
            ->color('success')
            ->url(fn (LogModel $record): string => route('view-log', $record))
            ->openUrlInNewTab(),
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
                return strtoupper($record->dependents_last_name) . ', ' . strtoupper($record->dependents_first_name) . ' ' . strtoupper($record->dependents_middle_name) .'.' ;
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('hospitals.name')
            ->label('HOSPITAL')
            ->searchable()
            ->sortable(),
            // TextColumn::make('enrollment_status')
            // ->label('ENROLLMENT STATUS')
            // ->searchable()
            // ->sortable(),
            TextColumn::make('amount')
            ->label('AMOUNT')
            ->searchable()
            ->sortable(),
            TextColumn::make('date_received')
            ->label('DATE RECEIVED')
            ->date('F d, Y')
            ->searchable()
            ->sortable(),
        ];
    }

    public function closeModal()
    {
        $this->addLog = false;
    }

    public function render()
    {
        return view('livewire.log');
    }
}
