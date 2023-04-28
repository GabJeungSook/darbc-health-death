<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use App\Models\Hospital as HospitalModel;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\Action;
use WireUi\Traits\Actions;
use DB;

class Hospital extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $addHospital = false;
    public $name;
    public $address;

    protected function getTableQuery(): Builder
    {
        return HospitalModel::query();
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
            ->label('Edit')
            ->color('success')
            ->mountUsing(fn (Forms\ComponentContainer $form, HospitalModel $record) => $form->fill([
                'name' => $record->name,
                'address' => $record->address,
            ]))
            ->action(function (HospitalModel $record, array $data): void {
                $record->name = $data['name'];
                $record->address = $data['address'];

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
                TextInput::make('address')
                    ->label('Address')
                    ->required(),
            ]),
            Action::make('delete')
            ->label('Delete')
            ->color('danger')
            ->action(fn ($record) => $record->delete())
            ->requiresConfirmation(),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
            ->label('NAME')
            ->searchable()
            ->sortable(),
            TextColumn::make('address')
            ->label('ADDRESS')
            ->searchable()
            ->sortable(),
        ];
    }

    public function redirectToHealth()
    {
        return redirect()->route('health');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        DB::beginTransaction();
        HospitalModel::create([
            'name' => $this->name,
            'address' => $this->address,
        ]);
        DB::commit();

        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully saved'
        );
        $this->addHospital = false;
        $this->reset([ 'name', 'address']);
    }

    public function render()
    {
        return view('livewire.hospital');
    }
}
