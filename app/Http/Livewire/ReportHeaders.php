<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use App\Models\ReportHeader;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\Action;
use WireUi\Traits\Actions;
use DB;

class ReportHeaders extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;


    protected function getTableQuery(): Builder
    {
        return ReportHeader::query();
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
            ->label('Edit Header')
            ->button()
            ->icon('heroicon-o-pencil')
            ->color('success')
            ->mountUsing(fn (Forms\ComponentContainer $form, ReportHeader $record) => $form->fill([
                'header' => $record->header,
            ]))
            ->action(function (ReportHeader $record, array $data): void {
                $record->header = $data['header'];

                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Data successfully updated'
                );
                $record->save();
            })
            ->form([
                TextInput::make('header')
                    ->label('Name')
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
            TextColumn::make('report_name')
            ->label('REPORT NAME')
            ->searchable()
            ->sortable(),
            TextColumn::make('header')
            ->label('HEADER')
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
        return view('livewire.report-headers');
    }
}
