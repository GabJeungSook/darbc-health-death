<?php

namespace App\Http\Livewire;

use DB;
use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use App\Models\Signatory;
use WireUi\Traits\Actions;
use App\Models\ReportHeader;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Signatories extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    protected function getTableQuery(): Builder
    {
        return Signatory::query()->whereHas('report_headers')->orderBy('report_header_id');
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Action::make('create')
            ->label('Add Signatory')
            ->button()
            ->icon('heroicon-o-plus-circle')
            ->color('primary')
            ->form([
                Select::make('report_header_id')
                ->label('Report Header')
                ->options(ReportHeader::all()->pluck('header', 'id')),
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('position')
                    ->label('Position')
                    ->required(),
                TextInput::make('description')
                    ->label('Description')
                    ->required(),
            ])
            ->action(function (array $data): void {
                Signatory::create([
                    'report_header_id' => $data['report_header_id'],
                    'name' => $data['name'],
                    'position' => $data['position'],
                    'description' => $data['description'],
                ]);

                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Data successfully added'
                );
            }),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
            ->label('Edit Signatory')
            ->button()
            ->icon('heroicon-o-pencil')
            ->color('success')
            ->mountUsing(fn (Forms\ComponentContainer $form, Signatory $record) => $form->fill([
                'name' => $record->name,
                'position' => $record->position,
                'description' => $record->description,
            ]))
            ->action(function (Signatory $record, array $data): void {
                $record->name = $data['name'];
                $record->position = $data['position'];
                $record->description = $data['description'];

                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Data successfully updated'
                );
                $record->save();
            })
            ->form([
                Grid::make(3)
                ->schema([
                    TextInput::make('name')
                    ->label('Name'),
                    TextInput::make('position')
                    ->label('Position'),
                    TextInput::make('description')
                    ->label('Description')
                    ->required()
                ])

            ])
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('report_headers.report_name')
            ->label('REPORT NAME')
            ->searchable()
            ->formatStateUsing(function ($record) {
                return strtoupper($record->report_headers?->report_name);
            })
            ->sortable(),
            TextColumn::make('name')
            ->label('NAME')
            ->searchable()
            ->sortable(),
            TextColumn::make('position')
            ->label('POSITION')
            ->searchable()
            ->sortable(),
            TextColumn::make('description')
            ->label('POSITION')
            ->searchable()
            ->sortable(),
        ];
    }

    public function render()
    {
        return view('livewire.signatories');
    }
}
