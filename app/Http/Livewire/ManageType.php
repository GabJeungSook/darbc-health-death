<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use WireUi\Traits\Actions;
use DB;

class ManageType extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $name;

    protected function getTableQuery(): Builder
    {
        return Type::query();
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
            ->label('Edit')
            ->button()
            ->icon('heroicon-o-pencil')
            ->color('success')
            ->mountUsing(fn (Forms\ComponentContainer $form, Type $record) => $form->fill([
                'name' => $record->name,
            ]))
            ->action(function (Type $record, array $data): void {
                $record->name = $data['name'];
                $record->save();

                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Data successfully updated'
                );
            })
            ->form([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
            ])->requiresConfirmation()
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Action::make('create')
            ->label('Add New Type')
            ->button()
            ->color('primary')
            ->icon('heroicon-o-plus')
            ->action(function (array $data): void {
                DB::beginTransaction();
                Type::create([
                    'name' => $data['name'],
                ]);
                DB::commit();
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Data successfully updated'
                );
            })
            ->form([
                Forms\Components\TextInput::make('name')->required(),
            ])
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
            ->label('NAME')
            ->searchable()
            ->sortable(),
        ];
    }

    public function render()
    {
        return view('livewire.manage-type');
    }
}
