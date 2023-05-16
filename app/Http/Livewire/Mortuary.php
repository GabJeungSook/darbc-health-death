<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use App\Models\Mortuary as MortuaryModel;
use App\Models\SupervisorCode;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\Position;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Wizard;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use DB;

class Mortuary extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $addMortuary = false;
    protected $listeners = ['close_mortuary_modal'=> 'closeModal'];

    protected function getTableQuery(): Builder
    {
        return MortuaryModel::query();
    }

    protected function getTableActionsPosition(): ?string
    {
        return Position::AfterCells;
    }

    public function getTableActions()
    {
        return [
            Action::make('view')
            ->icon('heroicon-o-eye')
            ->button()
            ->color('success')
            ->url(fn (MortuaryModel $record): string => route('view-mortuary', $record))
            ->openUrlInNewTab(),
            ActionGroup::make([
                Action::make('edit')
                ->icon('heroicon-o-pencil')
                ->button()
                ->color('primary')
                ->mountUsing(fn (Forms\ComponentContainer $form, MortuaryModel $record) => $form->fill([
                    'claimant_first_name' => $record->claimants_first_name,
                    'claimant_middle_name' => $record->claimants_middle_name,
                    'claimant_last_name' => $record->claimants_last_name,
                    'claimant_contact_number' => $record->claimants_contact_number,
                    'date_received' => $record->date_received,
                    'status' => $record->status,
                    'diamond_package' => $record->diamond_package,
                    'vehicle' => $record->vehicle,
                ]))
                ->action(function (MortuaryModel $record, array $data): void {
                    DB::beginTransaction();
                    $record->claimants_first_name = $data['claimant_first_name'];
                    $record->claimants_middle_name = $data['claimant_middle_name'];
                    $record->claimants_last_name = $data['claimant_last_name'];
                    $record->claimants_contact_number = $data['claimant_contact_number'];
                    $record->date_received = $data['date_received'];
                    $record->status = $data['status'];
                    $record->diamond_package = $data['diamond_package'];
                    $record->vehicle = $data['vehicle'];
                    $record->update_attempts = $record->update_attempts + 1;
                    $record->save();
                    DB::commit();
                    $this->dialog()->success(
                        $title = 'Success',
                        $description = 'Data successfully saved'
                    );
                })
                ->form([
                    Fieldset::make('Claimant\'s Information')
                    ->schema([
                        Forms\Components\TextInput::make('claimant_first_name')->label('First Name')->reactive()->required(),
                        Forms\Components\TextInput::make('claimant_middle_name')->label('Middle Name')->reactive(),
                        Forms\Components\TextInput::make('claimant_last_name')->label('Last Name')->reactive()->required(),
                        Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('claimant_contact_number')->label('Contact Number')
                            ->numeric()
                            ->reactive()
                        ])->columns(1),
                    ])
                    ->columns(3),
                    Forms\Components\DatePicker::make('date_received')
                    ->required(),
                    Card::make()
                    ->schema([
                        Forms\Components\Select::make('status')
                        ->options([
                            'Approved' => 'Approved',
                            'Pending' => 'Pending',
                        ])
                        ->required()
                        ->reactive(),
                        Forms\Components\Select::make('diamond_package')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No',
                            'Islam' => 'Islam',
                            'Distant' => 'Distant',
                        ])
                        ->required()
                        ->reactive(),
                        Forms\Components\Select::make('vehicle')
                        ->label('Avail Vehicle')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No',
                        ])
                        ->required()
                        ->reactive(),
                    ])->columns(3),
                ])->visible(fn ($record) => $record->update_attempts < 2),
                Action::make('code')
                ->label('Enter Supervisor Code')
                ->icon('heroicon-o-code')
                ->color('danger')
                ->action(function (MortuaryModel $record, array $data): void {
                    $code = SupervisorCode::first()->code;
                    if($data['supervisor_code'] === $code)
                    {
                        DB::beginTransaction();
                        $record->update_attempts = 0;
                        $record->save();
                        DB::commit();
                        $this->dialog()->success(
                            $title = 'Success',
                            $description = 'You may now edit this record with 2 attempts'
                        );
                    }else{
                        $this->dialog()->error(
                            $title = 'Invalid Code',
                            $description = 'Contact your supervisor to access the code.'
                        );
                    }
                })
                ->form([
                    Forms\Components\TextInput::make('supervisor_code')
                    ->label('Supervisor Code')
                    ->password()
                    ->required(),
                ])->visible(fn ($record) => $record->update_attempts == 2)
            ])
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('memberName')
            ->label('Member Name')
            ->formatStateUsing(function ($record) {
                $url = 'https://darbc.org/api/member-information/'.$record->member_id;
                $response = file_get_contents($url);
                $member_data = json_decode($response, true);

                $collection = collect($member_data['data']);

                return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']);
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('claimantName')
            ->label('Claimants Name')
            ->formatStateUsing(function ($record) {
                  return strtoupper($record->claimants_last_name) . ', ' . strtoupper($record->claimants_first_name) . ' ' . strtoupper($record->claimants_middle_name) ;
            })
            ->searchable()
            ->sortable(),
            BadgeColumn::make('status')
            ->enum([
                'Approved' => 'Approved',
                'Pending' => 'Pending',
            ])
            ->colors([
                'success' => 'Approved',
                'warning' => 'Pending',
            ]),
            BadgeColumn::make('diamond_package')
            ->enum([
                'Yes' => 'Yes',
                'No' => 'No',
                'Islam' => 'Islam',
                'Distant' => 'Distant',
            ])
            ->colors([
                'success' => 'Yes',
                'danger' => 'No',
                'warning' => 'Islam',
                'primary' => 'Distant'
            ]),
            BadgeColumn::make('vehicle')
            ->enum([
                'Yes' => 'Yes',
                'No' => 'No',
            ])
            ->colors([
                'success' => 'Yes',
                'danger' => 'No',
            ])
        ];
    }

    public function closeModal()
    {
        $this->addMortuary = false;
    }

    public function redirectToInquiry()
    {
        return redirect()->route('mortuary-inquiry');
    }

    public function redirectToReport()
    {
        return redirect()->route('mortuary-report');
    }


    public function render()
    {
        return view('livewire.mortuary');
    }
}
