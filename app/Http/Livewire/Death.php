<?php

namespace App\Http\Livewire;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use App\Models\Mortuary;
use WireUi\Traits\Actions;
use App\Models\SupervisorCode;
use App\Models\VehicleSchedule;
use App\Models\DeathTransmittal;
use App\Models\Death as deathModel;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Actions\Position;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;

class Death extends Component  implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $addDeath = false;
    public $addDeathForm = false;
    public $showRecord = false;
    public $showVehicleModal = false;

    public $member_ids;
    public $mortuary_ids;
    public $mortuary_id;
    public $date;
    public $batch_number;
    public $batch_number_transmittal;
    public $member_id;
    public $enrollment_status;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $dependents_first_name;
    public $dependents_middle_name;
    public $dependents_last_name;
    public $dependent_type;
    public $has_diamond_package;
    public $cash;
    public $grocery;
    public $water;
    public $birthday;
    public $age;
    public $contact_number;
    public $date_of_death;
    public $place_of_death;
    public $coverage_type;
    public $has_vehicle;
    public $amount;

    public $date_requested;
    public $schedule_first_name;
    public $schedule_middle_name;
    public $schedule_last_name;
    public $scheduled_date;
    public $vehicle_type;
    public $remarks;

    public $attachment = [];

    protected $listeners = [
        'close_modal'=> 'closeModal',
        'close_modal_death'=> 'closeModalDeath',
        'show_vehicle_schedule' =>'showVehicleSchedule',
        'close_vehicle' =>'CloseVehicleSchedule'
    ];

    protected function getTableQuery(): Builder
    {
        return deathModel::query();
    }

    protected function getTableActionsPosition(): ?string
    {
        return Position::AfterCells;
    }

    public function getTableActions()
    {
        return [
            Action::make('print_claim')
            ->label('Print Claim')
            ->icon('heroicon-o-printer')
            ->button()
            ->color('success')
            ->url(fn (deathModel $record): string => route('daily-claims-death', $record)),
            ActionGroup::make([
            Action::make('view_data')
            ->icon('heroicon-o-eye')
            ->color('primary')
            ->url(fn (deathModel $record): string => route('view-death', $record))
            ->openUrlInNewTab(),
            Action::make('edit')
            ->icon('heroicon-o-pencil')
            ->button()
            ->color('primary')
            ->mountUsing(fn (Forms\ComponentContainer $form, deathModel $record) => $form->fill([
                'mortuary_id' => $this->getDarbcFullName($record->member_id),
                'batch_number' => $record->batch_number,
                'member_id' => $this->getDarbcId($record->member_id),
                'date' => Carbon::parse($record->date)->format('F d, Y'),
                'enrollment_status' => $record->enrollment_status,
                'first_name' => $record->first_name,
                'middle_name' => $record->middle_name,
                'last_name' => $record->last_name,
                'dependents_first_name' => $record->dependents_first_name,
                'dependents_middle_name' => $record->dependents_middle_name,
                'dependents_last_name' => $record->dependents_last_name,
                'dependent_type' => $record->dependent_type,
                'has_diamond_package' => $record->mortuary->diamond_package,
                'islam_cash' => $record->has_diamond_package == 'Islam' ? '30000' : '0',
                'cash' => $record->has_diamond_package == 'Distant' || $record->has_diamond_package == 'No' ? '20000' : '0',
                'grocery' => $record->has_diamond_package == 'Distant' || $record->has_diamond_package == 'No' ? '2000' : '0',
                'water' => $record->has_diamond_package == 'Distant' || $record->has_diamond_package == 'No' ? '1000' : '0',
                'birthday' => $record->birthday,
                'age' => $record->age,
                'contact_number' => $record->contact_number,
                'date_of_death' => Carbon::parse($record->mortuary->date_of_death)->format('F d, Y'),
                'place_of_death' => $record->mortuary->place_of_death,
                'has_vehicle' => $record->mortuary->vehicle,
                'schedule_first_name' => $record->schedules->first()?->schedule_first_name,
                'schedule_middle_name' => $record->schedules->first()?->schedule_middle_name,
                'schedule_last_name' => $record->schedules->first()?->schedule_last_name,
                'date_requested' => $record->schedules->first()?->date_requested != null ? Carbon::parse($record->schedules->first()->date_requested)->format('F d, Y') : null,
                'scheduled_date' => $record->schedules->first()?->date_requested != null ? Carbon::parse($record->schedules->first()->scheduled_date)->format('F d, Y') : null,
                'vehicle_type' => $record->schedules->first()?->vehicle_type,
                'remarks' => $record->schedules->first()?->remarks,
                'coverage_type' => $record->coverage_type,
                'amount' => $record->amount,
            ]))
            ->action(function (deathModel $record, array $data): void {
                if($record->update_attempts == 2)
                {
                    $this->dialog()->error(
                        $title = 'PERMISSION REQUIRED',
                        $description = 'Supervisor Code reqiured after 2 attempts.'
                    );
                }else{
                    DB::beginTransaction();
                    $record->enrollment_status = $data['enrollment_status'];

                    if($data['enrollment_status'] == 'dependent')
                    {
                        $record->dependents_first_name = $data['dependents_first_name'];
                        $record->dependents_middle_name = $data['dependents_middle_name'];
                        $record->dependents_last_name = $data['dependents_last_name'];
                        $record->dependent_type = $data['dependent_type'];

                        $record->first_name = null;
                        $record->middle_name = null;
                        $record->last_name = null;
                    }else{
                        $record->first_name = $data['first_name'];
                        $record->middle_name = $data['middle_name'];
                        $record->last_name = $data['last_name'];

                        $record->dependents_first_name = null;
                        $record->dependents_middle_name = null;
                        $record->dependents_last_name = null;
                        $record->dependent_type = null;
                    }
                    $record->has_diamond_package = $data['has_diamond_package'];
                    $record->birthday = $data['birthday'];
                    $record->age = $data['age'];
                    $record->contact_number = $data['contact_number'];
                    $record->date_of_death = $data['date_of_death'];
                    $record->place_of_death = $data['place_of_death'];
                    $record->has_vehicle = $data['has_vehicle'];
                    $record->coverage_type = $data['coverage_type'];
                    $record->amount = $data['amount'];

                    if($data['has_vehicle'] == "Yes")
                    {
                        // $record->schedules->create([
                        //     'schedule_first_name' => $data['schedule_first_name'],
                        //     'schedule_middle_name' => $data['schedule_middle_name'],
                        //     'schedule_last_name' => $data['schedule_last_name'],
                        //     'date_requested' => $data['date_requested'],
                        //     'scheduled_date' => $data['scheduled_date'],
                        //     'vehicle_type' => $data['vehicle_type'],
                        //     'remarks' => $data['remarks'],
                        // ]);
                        $schedule = VehicleSchedule::firstOrNew(['id' => $record->id]);
                        $schedule->death_id = $record->id;
                        $schedule->schedule_first_name = $data['schedule_first_name'];
                        $schedule->schedule_middle_name = $data['schedule_middle_name'];
                        $schedule->schedule_last_name = $data['schedule_last_name'];
                        $schedule->date_requested = $data['date_requested'];
                        $schedule->scheduled_date = $data['scheduled_date'];
                        $schedule->vehicle_type = $data['vehicle_type'];
                        $schedule->remarks = $data['remarks'];
                        $schedule->save();
                    }
                    $record->update_attempts = $record->update_attempts + 1;
                    $record->save();
                    DB::commit();
                    $this->dialog()->success(
                        $title = 'Success',
                        $description = 'Data successfully updated'
                    );
                }
            })
            ->form([
                Wizard::make([
                    Wizard\Step::make('First Step')
                        ->schema([
                            Card::make()
                            ->schema([
                                Grid::make()
                                ->schema([
                                    Forms\Components\TextInput::make('mortuary_id')->label('Member')
                                    ->disabled()
                                    ->reactive()
                                ])->columns(1),
                                DatePicker::make('date')->label('Date')
                                ->disabled()
                                ->required(),
                                Forms\Components\TextInput::make('batch_number')->label('Batch No.')
                                ->disabled()
                                ->required(),
                                Forms\Components\TextInput::make('member_id')->label('DARBC ID')
                                ->reactive()
                                ->disabled()
                            ])->columns(3),
                            Forms\Components\Select::make('enrollment_status')->label('Are you a')
                            ->options([
                                'member' => 'Member',
                                'replacement' => 'Replacement',
                                'dependent' => 'Dependent',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function ($set, $get, $state) {
                                $url = 'https://darbcmembership.org/api/member-information/'.$get('member_id');
                                $response = Http::withOptions(['verify' => false])->get($url);
                                $member_data = $response->json();

                                $collection = collect($member_data['data']);
                                //$member = Member::where('member_id', $get('member_id'))->first();
                                if($state == 'member')
                                {
                                    $set('first_name', $collection['user']['first_name']);
                                    $set('middle_name',$collection['user']['middle_name']);
                                    $set('last_name', $collection['user']['surname']);
                                    $set('contact_number', $collection['contact_number']);
                                    $set('birthday', $collection['date_of_birth']);
                                    if($collection['date_of_birth'] != null)
                                    {
                                        $date_of_birth = $collection['date_of_birth'];
                                        $age = date_diff(date_create($date_of_birth), date_create('today'))->y;
                                        $set('age', $age);
                                    }else{
                                        $set('age', null);
                                    }
                                }else{
                                    $set('first_name', null);
                                    $set('middle_name', null);
                                    $set('last_name', null);
                                    $set('contact_number', null);
                                    $set('birthday', null);
                                    $set('age', null);
                                }
                                $set('dependents_first_name', null);
                                $set('dependents_middle_name', null);
                                $set('dependents_last_name', null);
                                // $set('birthday', null);
                                // $set('age', null);
                                // $set('contact_number', null);
                                // $set('date_of_death', null);
                                // $set('place_of_death', null);
                                // $set('coverage_type', null);
                                // $set('has_vehicle', null);
                                // $set('amount', 0);
                            })
                            ->required(),
                            Fieldset::make('Member\'s Name')
                            ->schema([
                                Forms\Components\TextInput::make('first_name')->label('First Name')->reactive()->disabled(fn ($get) => $this->member_id == null)->required(),
                                Forms\Components\TextInput::make('middle_name')->label('Middle Name')->disabled(fn ($get) => $this->member_id == null)->reactive(),
                                Forms\Components\TextInput::make('last_name')->label('Last Name')->disabled(fn ($get) => $this->member_id == null)->reactive()->required(),
                            ])->columns(3)->visible(fn ($get) => $get('enrollment_status') == 'member'),
                            Fieldset::make('Replacement\'s Name')
                            ->schema([
                                Forms\Components\TextInput::make('dependents_first_name')->label('First Name')->reactive()->required(),
                                Forms\Components\TextInput::make('dependents_middle_name')->label('Middle Name')->reactive(),
                                Forms\Components\TextInput::make('dependents_last_name')->label('Last Name')->reactive()->required(),
                                ])->columns(1),
                            Fieldset::make('Dependent\'s Name')
                            ->schema([
                                Forms\Components\TextInput::make('dependents_first_name')->label('First Name')->reactive()->required(),
                                Forms\Components\TextInput::make('dependents_middle_name')->label('Middle Name')->reactive(),
                                Forms\Components\TextInput::make('dependents_last_name')->label('Last Name')->reactive()->required(),
                                Grid::make()
                                ->schema([
                                    Forms\Components\Radio::make('dependent_type')
                                    ->label('Dependent Type')
                                    ->options([
                                        'spouse' => 'Spouse',
                                        'child' => 'Child',
                                    ])
                                    ->inline()
                                    ->required()
                                ])->columns(1),

                            ])->columns(3)->visible(fn ($get) => $get('enrollment_status') == 'dependent'),
                        ]),
                    Wizard\Step::make('Second Step')
                        ->schema([
                            Forms\Components\Select::make('has_diamond_package')->label('Avail Diamond Package?')
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                                'Islam' => 'Islam',
                                'Distant' => 'Distant',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function ($set, $get, $state) {
                                if($state == "Islam")
                                {
                                    $set('islam_cash', '30000');
                                }else{
                                    $set('cash', '20000');
                                    $set('grocery', '2000');
                                    $set('water', '1000');
                                }
                            })
                            ->required(),
                            Fieldset::make('Benefits')
                            ->schema([
                                Forms\Components\TextInput::make('cash')->label('Cash')->disabled()
                                ->reactive(),
                                Forms\Components\TextInput::make('grocery')->label('Grocery')->disabled()
                                ->reactive(),
                                Forms\Components\TextInput::make('water')->label('Water')->disabled()
                                ->reactive(),
                            ])->columns(3)->visible(fn ($get) => $get('has_diamond_package') == 'No' || $get('has_diamond_package') == 'Distant'),
                            Fieldset::make('Benefits')
                            ->schema([
                                Forms\Components\TextInput::make('islam_cash')->label('Cash')->disabled()
                                ->reactive(),
                            ])->columns(1)->visible(fn ($get) => $get('has_diamond_package') == 'Islam'),
                            Card::make()
                            ->schema([
                                DatePicker::make('birthday')->label('Birthday')
                                ->reactive()
                                ->afterStateUpdated(function ($set, $get, $state){
                                    $birthYear = date('Y', strtotime($state));
                                    $currentYear = date('Y');
                                    $age = $currentYear - $birthYear;
                                    $set('age', $age);


                                })
                                ->required(),
                                Forms\Components\TextInput::make('age')->label('Age')->reactive()->disabled()->required(),
                                Forms\Components\TextInput::make('contact_number')->label('Contact Number')
                                ->reactive()
                                ->required(),
                            ])->columns(3),
                        ]),
                    Wizard\Step::make('Third Step')
                        ->schema([
                            Card::make()
                            ->schema([
                                DatePicker::make('date_of_death')->label('Date Of Death')
                                ->disabled()
                                ->reactive()
                                ->required(),
                                Forms\Components\TextInput::make('place_of_death')->label('Place Of Death')
                                ->disabled()
                                ->reactive()
                                ->required(),
                                Forms\Components\Select::make('has_vehicle')->label('Vehicle')
                                ->options([
                                    'Yes' => 'Yes',
                                    'No' => 'No'
                                ])
                                ->afterStateUpdated(function ($set, $get, $state){
                                    if($state == 'Yes')
                                    {
                                        $set('coverage_type', null);
                                        $set('amount', 0);
                                    }else{
                                        $set('amount', $get('amount') + 1000);
                                    }
                                })
                                ->disabled()
                                ->reactive()
                                ->required(),
                                Forms\Components\Select::make('coverage_type')->label('Type Of Coverage')
                                ->options([
                                    '1' => 'Accidental Death/ Disablement',
                                    '2' => 'Accident Burial Benefit',
                                    '3' => 'Unprovoked Murder & Assault',
                                    '4' => 'Burial Benefit due to Natural Death',
                                    '5' => 'Motorcycling Coverage',
                                    '6' => 'Daily Hospital Income Benefit, due to accident and/or illness',
                                    '7' => 'Premium inclusive of taxes',
                                ])
                                ->reactive()
                                ->afterStateUpdated(function ($set, $get, $state){
                                    if($get('has_vehicle') == 'No')
                                    {
                                        $amount = 1000;
                                    }else{
                                        $amount = 0;
                                    }
                                    if($get('enrollment_status') == 'dependent' && $get('dependent_type') == 'spouse')
                                    {
                                        if($get('age') >= 18 && $get('age') <= 86)
                                        {
                                            switch ($state) {
                                                case '1':
                                                    $set('amount', $amount + 20000);
                                                  break;
                                                case '2':
                                                    $set('amount', $amount + 2000);
                                                  break;
                                                case '3':
                                                    $set('amount', $amount + 15000);
                                                  break;
                                                case '4':
                                                    $set('amount', $amount + 15000);
                                                  break;
                                                case '5':
                                                    $set('amount', $amount + 10000);
                                                  break;
                                                case '6':
                                                    $set('amount', $amount + 300);
                                                  break;
                                                default:
                                                $set('amount', $amount + 0);
                                              }
                                        }else{
                                            $this->dialog()->error(
                                                $title = 'Invalid Age!',
                                                $description = 'Spouse must be 18 - 86 years old.'
                                            );
                                            $set('birthday', null);
                                            $set('age', null);
                                        }
                                    }elseif($get('enrollment_status') == 'dependent' && $get('dependent_type') == 'child'){
                                        if($get('age') >= 1 && $get('age') <= 19)
                                        {
                                            switch ($state) {
                                                case '1':
                                                    $set('amount', $amount + 20000);
                                                  break;
                                                case '2':
                                                    $set('amount', $amount + 2000);
                                                  break;
                                                case '3':
                                                    $set('amount', $amount + 15000);
                                                  break;
                                                case '4':
                                                    $set('amount', $amount + 15000);
                                                  break;
                                                case '5':
                                                    $set('amount', $amount + 10000);
                                                  break;
                                                case '6':
                                                    $set('amount', $amount + 300);
                                                  break;
                                                default:
                                                $set('amount', $amount + 0);
                                              }
                                        }else{
                                            $this->dialog()->error(
                                                $title = 'Invalid Age!',
                                                $description = 'Child must be 1 - 19 years old.'
                                            );
                                            $set('birthday', null);
                                            $set('age', null);
                                        }
                                    }elseif($get('enrollment_status') == 'member'){
                                        if($get('age') >= 18 && $get('age') <= 60)
                                        {
                                            switch ($state) {
                                                case '1':
                                                    $set('amount', $amount + 100000);
                                                  break;
                                                case '2':
                                                    $set('amount', $amount + 10000);
                                                  break;
                                                case '3':
                                                    $set('amount', $amount + 50000);
                                                  break;
                                                case '4':
                                                    $set('amount', $amount + 55000);
                                                  break;
                                                case '5':
                                                    $set('amount', $amount + 50000);
                                                  break;
                                                case '6':
                                                    $set('amount', $amount + 1000);
                                                  break;
                                                case '7':
                                                    $set('amount', $amount + 2900);
                                                  break;
                                                default:
                                                $set('amount', 0);
                                              }
                                        }elseif($get('age') >= 61 && $get('age') <= 86){
                                            switch ($state) {
                                                case '1':
                                                    $set('amount', $amount + 100000);
                                                  break;
                                                case '2':
                                                    $set('amount',$amount +  10000);
                                                  break;
                                                case '3':
                                                    $set('amount', $amount + 50000);
                                                  break;
                                                case '4':
                                                    $set('amount', $amount + 55000);
                                                  break;
                                                case '5':
                                                    $set('amount', $amount + 50000);
                                                  break;
                                                case '6':
                                                    $set('amount', $amount + 1000);
                                                  break;
                                                case '7':
                                                    $set('amount', $amount + 4200);
                                                  break;
                                                default:
                                                $set('amount', $amount + 0);
                                              }
                                        }else{
                                            $this->dialog()->error(
                                                $title = 'Invalid Age!',
                                                $description = 'Member must be 18 - 86 years old.'
                                            );
                                            $set('birthday', null);
                                            $set('age', null);
                                        }
                                    }
                                })
                                ->required(),
                            ])->columns(2),
                            Fieldset::make('Vehicle Schedule')
                            ->schema([
                                Fieldset::make('Members Name')
                                ->schema([
                                    Forms\Components\TextInput::make('schedule_first_name')->label('First Name')->reactive(),
                                    Forms\Components\TextInput::make('schedule_middle_name')->label('Middle Name')->reactive(),
                                    Forms\Components\TextInput::make('schedule_last_name')->label('Last Name')->reactive(),
                                ])->columns(3),
                                DatePicker::make('date_requested')->label('Date Requested'),
                                DatePicker::make('scheduled_date')->label('Scheduled Date'),
                                Forms\Components\TextInput::make('vehicle_type')->label('Type Of Vehicle')->reactive(),
                                Forms\Components\TextInput::make('remarks')->label('Remarks')->reactive(),
                            ])->visible(fn ($get) => $get('has_vehicle') == 'Yes')
                        ]),

                    ]),
                Forms\Components\TextInput::make('amount')->label('Amount')->disabled(fn ($get) => $this->member_id == null)
                ->reactive()
                ->disabled()
                ->required(),
            ])->visible(fn ($record) => $record->update_attempts < 2),
            Action::make('code')
            ->label('Enter Supervisor Code')
            ->icon('heroicon-o-code')
            ->color('danger')
            ->visible(fn ($record) => $record->update_attempts == 2)
            ->action(function (deathModel $record, array $data): void {
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
            ]),
            Action::make('transmitted')
            ->icon('heroicon-o-arrow-right')
            ->color('warning')
            ->mountUsing(fn (Forms\ComponentContainer $form, deathModel $record) => $form->fill([
                'batch_number' => $this->batch_number_transmittal,
                'date_transmitted' =>now()
            ]))
            ->action(function (deathModel $record, array $data): void {
                DB::beginTransaction();
                $death = DeathTransmittal::create([
                    'death_id' => $record->id,
                    'batch_number' => $this->batch_number_transmittal,
                    'date_transmitted' => $data['date_transmitted'],
                ]);

                  //save Files from fileupload
                foreach($data['attachment'] as $document){
                    $death->attachments()->create(
                        [
                             "path"=>'public/'.$document,
                             "document_name"=>$document,
                        ]
                    );
                }

                $record->status = 'TRANSMITTED';
                $record->save();
                DB::commit();
                $this->dialog()->success(
                    $title = 'Success',
                    $description = 'Data successfully saved'
                );
            })
            ->form([
                Forms\Components\TextInput::make('batch_number')
                ->label('Batch Number')
                ->disabled(),
                DatePicker::make('date_transmitted')->label('Date Transmitted')
                ->required()
                ->reactive(),
                FileUpload::make('attachment')
                ->enableOpen()
                ->multiple()
                ->disk('public')
                ->preserveFilenames()
                ->reactive()
            ])->requiresConfirmation()->visible(fn ($record) => $record->status == "ENCODED"),
            Action::make('delete')
            ->color('danger')
            ->icon('heroicon-o-trash')
            ->action(fn ($record) => $record->delete())
            ->requiresConfirmation()
        ])
        ];

    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('date')
                ->label('DATE')
                ->date('F d, Y')
                ->searchable(),
            TextColumn::make('memberName')
                ->formatStateUsing(function ($record) {
                    $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                    $response = Http::withOptions(['verify' => false])->get($url);
                    $member_data = $response->json();

                    $collection = collect($member_data['data']);

                    return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) ;
                })
                ->label('MEMBER NAME')
                ->searchable(['first_name', 'last_name']),
            TextColumn::make('enrollment_status')
            ->sortable()
            ->formatStateUsing(function ($record) {
                return strtoupper($record->enrollment_status);
            })
            ->label('ENROLLMENT STATUS')
            ->searchable(['enrollment_status']),
            TextColumn::make('dependents_name')
                ->label('DEPENDENT\'S / REPLACEMENT\'S NAME')
                ->formatStateUsing(function ($record) {
                    $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                    $response = Http::withOptions(['verify' => false])->get($url);
                    $member_data = $response->json();

                    $collection = collect($member_data['data']);
                    if($record->enrollment_status == 'member')
                    {
                        return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) ;
                    }else{
                        return strtoupper($record->dependents_last_name) . ', ' . strtoupper($record->dependents_first_name) . ' ' . strtoupper($record->dependents_middle_name) ;
                    }
                })
                ->searchable(),
                BadgeColumn::make('mortuary.diamond_package')
                ->label('DIAMOND PACKAGE')
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
                ])
                ->formatStateUsing(function ($record) {
                    return strtoupper($record->has_diamond_package);
                }),
            TextColumn::make('mortuary.date_of_death')
                ->label('DATE OF DEATH')
                ->date('F d, Y'),
            TextColumn::make('mortuary.place_of_death')
                ->label('PLACE OF DEATH')
                ->formatStateUsing(function ($record) {
                    return strtoupper($record->mortuary->place_of_death);
                })
                ->searchable(),
            TextColumn::make('amount')
                ->label('AMOUNT')
                ->formatStateUsing(function ($record) {
                    return   number_format($record->amount, 2, '.', ',');
                })
                ->searchable(),
        ];
    }

    public function closeModal()
    {
        $this->addDeath = false;
    }

    public function closeModalDeath()
    {
        $this->addDeathForm = false;
    }

    public function showVehicleSchedule()
    {
        $this->addDeath = false;
        $this->showVehicleModal = true;
    }

    public function CloseVehicleSchedule()
    {
        $this->showVehicleModal = false;
        $this->addDeath = true;
    }


    public function redirectToCalendar()
    {
        return redirect()->route('calendar');
    }

    public function redirectToInquiry()
    {
        return redirect()->route('death-inquiry');
    }

    public function redirectToReport()
    {
        return redirect()->route('death-report');
    }

    public function getDarbcFullName($member_id)
    {
        $mortuary = Mortuary::where('member_id', $member_id)->first();
        return $mortuary->member_name;
    }

    public function getDarbcId($member_id)
    {
        $url = 'https://darbcmembership.org/api/member-information/'.$member_id;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $collection = collect($member_data['data']);
        return $collection['darbc_id'];

    }

    public function mount()
    {
        if (deathModel::count() > 0) {
            // get the latest record
            $latestData = deathModel::latest('created_at')->first();

            // check if today is Monday and the latest record was created on Sunday
            $isWednesday = Carbon::today()->isWednesday();
            $isNotWednesday = !$latestData->created_at->isWednesday();

            $isFriday = Carbon::today()->isFriday();
            $isNotFriday = !$latestData->created_at->isFriday();

            if (($isWednesday && $isNotWednesday) || ($isFriday && $isNotFriday)) {
                // increment the batch number if it's a Monday and the latest record was created on Sunday
                $this->batch_number_transmittal = $latestData->batch_number + 1;
            } else {
                // otherwise, use the latest batch number
                $this->batch_number_transmittal = $latestData->batch_number;
            }
        } else {
            $this->batch_number_transmittal = 1;
        }
    }

    public function render()
    {
        return view('livewire.death');
    }
}
