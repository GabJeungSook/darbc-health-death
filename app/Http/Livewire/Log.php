<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Tables\Actions\Position;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use App\Models\Log as LogModel;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use App\Models\Hospital;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Closure;
use DB;

class Log extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $addLog = false;
    public $member_id;
    public $member_full_names;
    public $enrollment_status;
    public $patients_first_name;
    public $patients_middle_name;
    public $patients_last_name;
    public $dependents_first_name;
    public $dependents_middle_name;
    public $dependents_last_name;
    public $hospital_id;
    public $amount;
    public $date_received;

    protected $listeners = ['close_modal'=> 'closeModal'];

    protected function getTableQuery(): Builder
    {
        return LogModel::query()->latest();
    }

    protected function getTableActionsPosition(): ?string
    {
        return Position::BeforeCells;
    }

    public function getTableActions()
    {
        return [
            ViewAction::make()
            ->button()
            ->label('View Log')
            ->color('success')
            ->url(fn (LogModel $record): string => route('view-log', $record))
            ->openUrlInNewTab(),
            ActionGroup::make([
                Action::make('edit')
                ->label('Edit')
                ->color('warning')
                ->icon('heroicon-o-pencil')
                ->mountUsing(fn (Forms\ComponentContainer $form, LogModel $record) => $form->fill([
                    'full_name' => $record->member_id,
                    'member_id' => $this->getDarbcId($record->member_id),
                    'enrollment_status' => $record->enrollment_status,
                    'patients_first_name' => $record->first_name,
                    'patients_middle_name' => $record->middle_name,
                    'patients_last_name' => $record->last_name,
                    'dependents_first_name' => $record->dependents_first_name,
                    'dependents_middle_name' => $record->dependents_middle_name,
                    'dependents_last_name' => $record->dependents_last_name,
                    'hospital_id' => $record->hospital_id,
                    'amount' => $record->amount,
                    'date_received' => $record->date_received,
                ]))
                ->action(function (LogModel $record, array $data): void {
                    $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                    $response = Http::withOptions(['verify' => false])->get($url);
                    $member_data = $response->json();

                    $collection = collect($member_data['data']);

                    $record->member_id = $data['full_name'];
                    $record->enrollment_status = $data['enrollment_status'];

                    if($data['enrollment_status'] == 'member')
                    {
                        // dd($collection['user']['first_name']);
                        $record->first_name = $data['patients_first_name'];
                        $record->middle_name = $data['patients_middle_name'];
                        $record->last_name = $data['patients_last_name'];
                        $record->dependents_first_name = $data['patients_first_name'];
                        $record->dependents_middle_name = $data['patients_middle_name'];
                        $record->dependents_last_name = $data['patients_last_name'];
                    }else{
                        $record->first_name = $data['patients_first_name'];
                        $record->middle_name = $data['patients_middle_name'];
                        $record->last_name = $data['patients_last_name'];
                        $record->dependents_first_name = $data['dependents_first_name'];
                        $record->dependents_middle_name = $data['dependents_middle_name'];
                        $record->dependents_last_name = $data['dependents_last_name'];
                    }
                    $record->hospital_id = $data['hospital_id'];
                    $record->amount = $data['amount'];
                    $record->date_received = $data['date_received'];
                    $record->save();

                        $this->dialog()->success(
                            $title = 'Success',
                            $description = 'Data successfully updated'
                        );
                })
                ->form([
                    Forms\Components\Select::make('full_name')->label('DARBC Member')
                    ->reactive()
                    ->preload()
                    ->searchable()
                    ->options($this->member_full_names->pluck('full_name', 'id'))
                    ->afterStateUpdated(function ($set, $get, $state) {
                        $url = 'https://darbcmembership.org/api/member-information/'.$state;
                        $response = Http::withOptions(['verify' => false])->get($url);
                        $member_data = $response->json();

                        if( $member_data === null)
                        {
                            // dd($member_data);
                            return '---';
                        }else{
                            $collection = collect($member_data['data']);
                            $set('member_id', $collection['darbc_id']);
                                //$member = Member::where('member_id', $state)->first();
                            if($get('enrollment_status') == 'member')
                            {
                                $set('patients_first_name', $collection['user']['first_name']);
                                $set('patients_middle_name',$collection['user']['middle_name']);
                                $set('patients_last_name', $collection['user']['surname']);
                            }elseif($state == 'dependent'){
                                $set('patients_first_name', null);
                                $set('patients_middle_name', null);
                                $set('patients_last_name', null);
                            }
                        }
                        }),
                    Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('member_id')->label('DARBC ID')
                        ->disabled()
                        ->reactive()
                        ->required(),
                        Forms\Components\Select::make('enrollment_status')->label('Are you a')
                        ->options([
                            'member' => 'Member',
                            'dependent' => 'Dependent',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($set, $get, $state, $record) {
                            $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                            $response = Http::withOptions(['verify' => false])->get($url);
                            $member_data = $response->json();

                            $collection = collect($member_data['data']);
                            //$member = Member::where('member_id', $get('member_id'))->first();
                            if($state == 'member')
                            {
                                $set('patients_first_name', $collection['user']['first_name']);
                                $set('patients_middle_name',$collection['user']['middle_name']);
                                $set('patients_last_name', $collection['user']['surname']);
                            }elseif($state == 'dependent'){
                                $set('patients_first_name', null);
                                $set('patients_middle_name', null);
                                $set('patients_last_name', null);
                            }
                        })
                        ->required(),
                    ])->columns(2),
                    Fieldset::make('Member\'s Name')
                    ->schema([
                        Forms\Components\TextInput::make('patients_first_name')->label('First Name')->reactive()->disabled(fn ($get) => $get('member_id') == null)->reactive()->required(),
                        Forms\Components\TextInput::make('patients_middle_name')->label('Middle Name')->disabled(fn ($get) =>  $get('member_id') == null)->reactive(),
                        Forms\Components\TextInput::make('patients_last_name')->label('Last Name')->disabled(fn ($get) =>  $get('member_id') == null)->reactive()->required(),
                    ])->visible(fn ($get) => $get('enrollment_status') == 'member')->columns(3),
                    Fieldset::make('Dependent\'s Name')
                    ->schema([
                        Forms\Components\TextInput::make('dependents_first_name')->label('First Name')->disabled(fn ($get) =>  $get('member_id') == null)->reactive()->required(),
                        Forms\Components\TextInput::make('dependents_middle_name')->label('Middle Name')->disabled(fn ($get) =>  $get('member_id') == null)->reactive(),
                        Forms\Components\TextInput::make('dependents_last_name')->label('Last Name')->disabled(fn ($get) =>  $get('member_id') == null)->reactive()->required(),
                    ])->visible(fn ($get) => $get('enrollment_status') == 'dependent')->columns(3),
                    Card::make()
                    ->schema([
                        Forms\Components\Select::make('hospital_id')->label('Hospital')
                        ->options(Hospital::all()->pluck('name', 'id'))
                        ->required(),
                        Forms\Components\TextInput::make('amount')
                        ->numeric()
                        ->reactive()
                        ->required(),
                        DatePicker::make('date_received')->label('Date Received')
                        ->reactive()
                        ->required()
                    ])->columns(3)
                    ]),
                    Action::make('delete')
                    ->label('Delete')
                    ->button()
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->action(fn ($record) => $record->delete())
                    ->requiresConfirmation(),
                    ])

        ];

    }

    public function getDarbcId($member_id)
    {
        $url = 'https://darbcmembership.org/api/member-information/'.$member_id;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $collection = collect($member_data['data']);
        return $collection['darbc_id'];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('member_id')
            ->label('DARBC ID')
            ->searchable()
            ->formatStateUsing(function ($record) {
                $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                $response = Http::withOptions(['verify' => false])->get($url);
                $member_data = $response->json();

                $collection = collect($member_data['data']);

                return $collection['darbc_id'];
            })
            ->sortable(),
            TextColumn::make('enrollment_status')
            ->formatStateUsing(function ($record) {
                return $record->enrollment_status == 'member' ? 'M' : 'D' ;
            })
            ->label('ENROLLMENT STATUS')
            ->searchable()
            ->sortable(),
            TextColumn::make('memberName')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) ;
            })
            ->label('MEMBERS NAME')
            ->searchable(['first_name', 'last_name']),
            TextColumn::make('patientName')
            ->label('DEPENDENT')
            ->formatStateUsing(function ($record) {
                if($record->enrollment_status == 'member')
                {
                    return '---';
                }else{
                    return strtoupper($record->dependents_last_name) . ', ' . strtoupper($record->dependents_first_name) . ' ' . strtoupper($record->dependents_middle_name);
                }
            })
            ->searchable(['dependents_last_name', 'dependents_first_name'])
            ->sortable(),
            TextColumn::make('hospitals.name')
            ->label('HOSPITAL')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->hospitals?->name);
            })
            ->searchable()
            ->sortable(),
            // TextColumn::make('enrollment_status')
            // ->label('ENROLLMENT STATUS')
            // ->searchable()
            // ->sortable(),
            TextColumn::make('amount')
            ->label('AMOUNT')
            ->searchable()
            ->formatStateUsing(function ($record) {
                return   number_format($record->amount, 2, '.', ',');
            })
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

    public function redirectToReport()
    {
        return redirect()->route('log-report');
    }
    public function mount()
    {
        $url = 'https://darbcmembership.org/api/member-darbc-names?status=1';
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $this->member_full_names = collect($member_data);
    }

    public function render()
    {
        return view('livewire.log');
    }
}
