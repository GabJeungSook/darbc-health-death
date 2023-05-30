<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use App\Models\Purpose;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use WireUi\Traits\Actions;
use DB;

class ManagePurpose extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $name;

    protected function getTableQuery(): Builder
    {
        return Purpose::query();
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
            ->label('Edit')
            ->button()
            ->icon('heroicon-o-pencil')
            ->color('success')
            ->mountUsing(fn (Forms\ComponentContainer $form, Purpose $record) => $form->fill([
                'name' => $record->name,
            ]))
            ->action(function (Purpose $record, array $data): void {
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
            ->label('Add New Purpose')
            ->button()
            ->color('primary')
            ->icon('heroicon-o-plus')
            ->action(function (array $data): void {
                DB::beginTransaction();
                Purpose::create([
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

    public function redirectToCommunityRelation()
    {
        return redirect()->route('community-relations');
    }

    public function render()
    {
        return view('livewire.manage-purpose');
    }
}
