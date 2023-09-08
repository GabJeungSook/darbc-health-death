<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use App\Models\ReportSignatory as ReportSignatoryModel;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\Action;
use WireUi\Traits\Actions;
use DB;

class ReportSignatory extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    protected function getTableQuery(): Builder
    {
        return ReportSignatoryModel::query();
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
            ->label('Edit Signatory')
            ->button()
            ->icon('heroicon-o-pencil')
            ->color('success')
            ->mountUsing(fn (Forms\ComponentContainer $form, ReportSignatoryModel $record) => $form->fill([
                'name' => $record->name,
                'position' => $record->position,
            ]))
            ->action(function (ReportSignatoryModel $record, array $data): void {
                $record->name = $data['name'];
                $record->position = $data['position'];


                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Data successfully updated'
                );
                $record->save();
            })
            ->form([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('position')
                    ->label('Position')
                    ->required()
            ])
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('reports.name')
            ->label('REPORT TYPE')
            ->searchable()
            ->formatStateUsing(function ($record) {
                return strtoupper($record->reports->name);
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
        ];
    }

    public function redirectToHealth()
    {
        return redirect()->route('health');
    }

    public function render()
    {
        return view('livewire.report-signatory');
    }
}
