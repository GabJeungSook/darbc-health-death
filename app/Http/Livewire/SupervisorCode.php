<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Models\SupervisorCode as SupervisorCodeModel;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\Action;
use WireUi\Traits\Actions;
use DB;

class SupervisorCode extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $addCode = false;
    public $code;
    public $address;

    protected function getTableQuery(): Builder
    {
        return SupervisorCodeModel::query();
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')
            ->label('Edit Code')
            ->button()
            ->icon('heroicon-o-pencil')
            ->requiresConfirmation()
            ->color('success')
            ->action(function (SupervisorCodeModel $record, array $data): void {
                $old_code = SupervisorCodeModel::first();

                if($data['old_code'] == $old_code->code)
                {
                    if($data['new_code'] == $data['new_code_confirm'])
                    {
                        $record->code = $data['new_code'];
                        $record->save();

                        $this->dialog()->success(
                            $title = 'Success',
                            $description = 'Data successfully updated'
                        );
                    }else{
                        $this->dialog()->error(
                            $title = 'Code Mismatch',
                            $description = 'New code and confirm new code did not match'
                        );
                    }
                }else{
                    $this->dialog()->error(
                        $title = 'Invalid Code',
                        $description = 'Old code does not match'
                    );
                }
            })
            ->form([
                TextInput::make('old_code')
                    ->label('Old Code')
                    ->password()
                    ->required(),
                TextInput::make('new_code')
                    ->label('New Code')
                    ->password()
                    ->required(),
                TextInput::make('new_code_confirm')
                    ->label('Confirm New Code')
                    ->password()
                    ->required(),
            ]),
        ];
    }


    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('code')
            ->label('SUPERVISOR CODE')
            ->formatStateUsing(function ($record) {
                return '******';
            }),
        ];
    }

    public function redirectToHealth()
    {
        return redirect()->route('health');
    }

    public function save()
    {
        $this->validate([
            'code' => 'required',
        ]);

        DB::beginTransaction();
        SupervisorCodeModel::create([
            'code' => $this->code,
        ]);
        DB::commit();

        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully saved'
        );
        $this->addCode = false;
        $this->reset([ 'code']);
    }

    public function openModal()
    {
        if(SupervisorCodeModel::get()->count() == 1)
        {
            $this->dialog()->error(
                $title = 'Maximum Code Reached',
                $description = 'Only one (1) supervisor code is allowed.'
            );
        }else{
            $this->addCode = true;
        }
    }

    public function render()
    {
        return view('livewire.supervisor-code');
    }
}
