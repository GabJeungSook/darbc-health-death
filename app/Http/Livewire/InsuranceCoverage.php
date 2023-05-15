<?php

namespace App\Http\Livewire;
use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Forms\Components\TextInput;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\Position;
use App\Models\InsuranceCoverage as InsuranceCoverageModel;
use App\Models\CoverageHistory;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use DB;
class InsuranceCoverage extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;
    public $viewHistory = false;

    protected function getTableQuery(): Builder
    {
        return InsuranceCoverageModel::query();
    }

    protected function getTableActionsPosition(): ?string
    {
        return Position::AfterCells;
    }

    public function getTableActions()
    {
        return [
            Action::make('edit')
            ->color('success')
            ->icon('heroicon-o-pencil')
            ->button()
            ->mountUsing(fn (Forms\ComponentContainer $form, InsuranceCoverageModel $record) => $form->fill([
                'amount' => $record->amount,
                'number_of_days' => $record->number_of_days,
                'category' => strtoupper($record->category),
            ]))
            ->action(function (InsuranceCoverageModel $record, array $data): void {
                DB::beginTransaction();
                $record->amount = $data['amount'];
                $record->number_of_days = $data['number_of_days'];
                $record->category = $data['category'];
                $record->save();

                CoverageHistory::create([
                    'amount' => $data['amount'],
                    'number_of_days' => $data['number_of_days'],
                    'category' => $data['category'],
                    'date_implemented' => now(),
                ]);
                DB::commit();

                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Data successfully updated'
                );
            })
            ->form([
                TextInput::make('amount')
                ->required()
                ->numeric(),
                TextInput::make('number_of_days')
                ->required()
                ->numeric(),
                TextInput::make('category')
                ->required()
            ])->requiresConfirmation()
        ];

    }

    public function getTableColumns(): array
    {
        return [
            TextColumn::make('amount')
            ->label('AMOUNT')
            ->searchable()
            ->sortable(),
            TextColumn::make('number_of_days')
            ->label('NUMBER OF DAYS')
            ->searchable()
            ->sortable(),
            TextColumn::make('category')
            ->label('CATEGORY')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->category);
            })
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
        return view('livewire.insurance-coverage');
    }
}
