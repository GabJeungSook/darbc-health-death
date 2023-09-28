<?php

namespace App\Http\Livewire\Forms;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\Death;
use Livewire\Component;
use App\Models\Mortuary;
use WireUi\Traits\Actions;
use App\Models\VehicleSchedule;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class AddDeath extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    // public $data;
    public $member_ids;
    public $global_member_id;
    public $mortuary_ids;
    public $mortuary_id;
    public $date;
    public $batch_number;
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

    // protected function getFormStatePath(): string
    // {
    //     return 'data';
    // }

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Step 1')
                    ->schema([
                        Card::make()
                        ->schema([
                            Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('member_id')->label('DARBC ID')
                                ->reactive()
                                ->disabled(),
                                Forms\Components\Select::make('mortuary_id')->label('Member')
                                ->reactive()
                                ->searchable()
                                ->options(Mortuary::whereDoesntHave('death')->pluck('member_name', 'id'))
                                ->afterStateUpdated(function ($set, $get, $state) {
                                    $mortuary = Mortuary::where('id', $state)->first();
                                    $url = 'https://darbcmembership.org/api/member-information/'.$mortuary->member_id;
                                    $response = Http::withOptions(['verify' => false])->get($url);
                                    $member_data = $response->json();
                                    $collection = collect($member_data['data']);

                                    $set('member_id', $collection['darbc_id']);
                                    $this->global_member_id = $collection['id'];
                                    $set('has_diamond_package', $mortuary->diamond_package);
                                    $set('has_vehicle', $mortuary->vehicle);
                                    $set('coverage_type', $mortuary->coverage_type);
                                    $set('birthday', $collection['date_of_birth']);
                                    $set('contact_number', $collection['contact_number']);

                                    if($get('has_diamond_package') === "Islam")
                                    {
                                        $set('islam_cash', '30000');
                                    }else{
                                        $set('cash', '20000');
                                        $set('grocery', '2000');
                                        $set('water', '1000');
                                    }

                                })
                            ])->columns(1),
                            DatePicker::make('date')->label('Date')
                            ->disabled()
                            ->required(),
                            Forms\Components\TextInput::make('batch_number')->label('Batch No.')
                            ->disabled()
                            ->required(),

                            // ->afterStateUpdated(function ($set, $get, $state) {
                            //     $url = 'https://darbcmembership.org/api/member-information/'.$get('full_name');
                            //     $response = file_get_contents($url);
                            //     $member_data = json_decode($response, true);

                            //     $collection = collect($member_data['data']);
                            //     //$member = Member::where('member_id', $state)->first();
                            //     if($get('enrollment_status') == 'member')
                            //     {
                            //         $set('first_name', $collection['user']['first_name']);
                            //         $set('middle_name',$collection['user']['middle_name']);
                            //         $set('last_name', $collection['user']['surname']);
                            //         $set('contact_number', $collection['contact_number']);
                            //         $set('birthday', $collection['date_of_birth']);
                            //         if($collection['date_of_birth'] != null)
                            //         {
                            //             $date_of_birth = $collection['date_of_birth'];
                            //             $age = date_diff(date_create($date_of_birth), date_create('today'))->y;
                            //             $set('age', $age);
                            //         }else{
                            //             $set('age', null);
                            //         }
                            //     }else{
                            //         $set('first_name', null);
                            //         $set('middle_name', null);
                            //         $set('last_name', null);
                            //         $set('contact_number', null);
                            //         $set('birthday', null);
                            //         $set('age', null);
                            //     }
                            // })
                            // ->searchable()
                            // ->getOptionLabelUsing(fn ($value): ?string => Member::find($value)?->member_id)->required(),

                        ])->columns(3),
                        Forms\Components\Select::make('enrollment_status')->label('Are you a')->disabled(fn ($get) => $this->member_id == null)
                        ->options([
                            'member' => 'Member',
                            'dependent' => 'Dependent',
                        ])
                        ->reactive()
                        ->afterStateUpdated(function ($set, $get, $state) {
                            $url = 'https://darbcmembership.org/api/member-information/'.$this->global_member_id;
                            $response = Http::withOptions(['verify' => false])->get($url);
                            $member_data = $response->json();

                            $collection = collect($member_data['data']);
                            //$member = Member::where('member_id', $get('member_id'))->first();
                            if($state == 'member')
                            {
                                $record = Mortuary::find($get('mortuary_id'));
                                $set('first_name', $collection['user']['first_name']);
                                $set('middle_name',$collection['user']['middle_name']);
                                $set('last_name', $collection['user']['surname']);
                                $set('contact_number', $collection['contact_number']);
                                $set('birthday', $collection['date_of_birth']);
                                $set('date_of_death', $record->date_of_death);
                                $set('place_of_death', $record->place_of_death);
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
                                $set('date_of_death', null);
                                $set('place_of_death', null);
                            }
                            $set('dependents_first_name', null);
                            $set('dependents_middle_name', null);
                            $set('dependents_last_name', null);


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
                                    switch ($get('coverage_type')) {
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
                                    switch ($get('coverage_type')) {
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
                                    switch ($get('coverage_type')) {
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
                                    switch ($get('coverage_type')) {
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
                        ])->columns(3)->visible(fn ($get) => $this->enrollment_status == 'member'),
                        Fieldset::make('Dependent\'s Name')
                        ->schema([
                            Forms\Components\TextInput::make('dependents_first_name')->label('First Name')->disabled(fn ($get) => $this->member_id == null)->reactive()->required(),
                            Forms\Components\TextInput::make('dependents_middle_name')->label('Middle Name')->disabled(fn ($get) => $this->member_id == null)->reactive(),
                            Forms\Components\TextInput::make('dependents_last_name')->label('Last Name')->disabled(fn ($get) => $this->member_id == null)->reactive()->required(),
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

                        ])->columns(3)->visible(fn ($get) => $this->enrollment_status == 'dependent'),
                    ]),
                Wizard\Step::make('Step 2')
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
                        ])->columns(3)->visible(fn ($get) => $this->has_diamond_package == 'No' || $this->has_diamond_package == 'Distant'),
                        Fieldset::make('Benefits')
                        ->schema([
                            Forms\Components\TextInput::make('islam_cash')->label('Cash')->disabled()
                            ->reactive(),
                        ])->columns(1)->visible(fn ($get) => $this->has_diamond_package == 'Islam'),
                        Card::make()
                        ->schema([
                            DatePicker::make('birthday')->label('Birthday')->disabled(fn ($get) => $this->member_id == null)
                            ->reactive()
                            ->afterStateUpdated(function ($set, $get, $state){
                                $birthYear = date('Y', strtotime($state));
                                $currentYear = date('Y');
                                $age = $currentYear - $birthYear;
                                $set('age', $age);
                                $set('coverage_type', null);
                                // $set('has_vehicle', null);
                                $set('amount', 0);

                            })
                            ->required(),
                            Forms\Components\TextInput::make('age')->label('Age')->reactive()->disabled()->required(),
                            Forms\Components\TextInput::make('contact_number')->label('Contact Number')->disabled(fn ($get) => $this->member_id == null)
                            ->reactive()
                            ->required(),
                        ])->columns(3),
                    ]),
                Wizard\Step::make('Step 3')
                    ->schema([
                        Card::make()
                        ->schema([
                            DatePicker::make('date_of_death')->label('Date Of Death')->disabled(fn ($get) => $this->member_id == null)
                            ->disabled()
                            ->reactive()
                            ->required(),
                            Forms\Components\TextInput::make('place_of_death')->label('Place Of Death')->disabled(fn ($get) => $this->member_id == null)
                            ->disabled()
                            ->reactive()
                            ->required(),
                            Forms\Components\TextInput::make('has_vehicle')->label('Vehicle')
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
                            Forms\Components\Select::make('coverage_type')->label('Type Of Coverage')->disabled(fn ($get) => $this->member_id == null)
                            ->options([
                                '1' => 'Accidental Death/ Disablement',
                                '2' => 'Accident Burial Benefit',
                                '3' => 'Unprovoked Murder & Assault',
                                '4' => 'Burial Benefit due to Natural Death',
                                '5' => 'Motorcycling Coverage',
                                '6' => 'Daily Hospital Income Benefit, due to accident and/or illness',
                                '7' => 'Premium inclusive of taxes',
                            ])
                            ->disabled()
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
                        ])->visible(fn ($get) => $this->has_vehicle == 'Yes')
                    ]),
                    Wizard\Step::make('Step 4')
                    ->schema([
                        FileUpload::make('attachment')
                        ->enableOpen()
                        ->multiple()
                        ->disk('public')
                        ->preserveFilenames()
                        ->reactive()
                    ])
                ]),
            Forms\Components\TextInput::make('amount')->label('Amount')->disabled(fn ($get) => $this->member_id == null)
            ->reactive()
            ->disabled()
            ->required(),
        ];

    }
    public function closeModal()
    {
        $this->reset([
            'date','batch_number','member_id', 'mortuary_id',
            'enrollment_status','first_name', 'middle_name',
            'last_name', 'dependents_first_name', 'dependents_middle_name',
            'dependents_last_name', 'dependent_type', 'has_diamond_package',
            'birthday', 'age', 'contact_number', 'date_of_death', 'place_of_death', 'coverage_type', 'has_vehicle',
            'amount'
        ]);
        $this->emit('close_modal_death');
    }

    public function save()
    {
        $this->validate();

        if($this->has_vehicle == 'Yes')
        {
            // $this->emit('show_vehicle_schedule');
            DB::beginTransaction();
            $death = Death::create([
                'member_id' => $this->global_member_id,
                'mortuary_id' => $this->mortuary_id,
                'batch_number' => $this->batch_number,
                'date' => $this->date,
                'enrollment_status' => $this->enrollment_status,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'dependents_first_name' => $this->dependents_first_name,
                'dependents_middle_name' => $this->dependents_middle_name,
                'dependents_last_name' => $this->dependents_last_name,
                'dependent_type' =>  $this->dependent_type,
                'has_diamond_package' =>  $this->has_diamond_package,
                'birthday' =>  $this->birthday,
                'age' =>  $this->age,
                'contact_number' =>  $this->contact_number,
                'date_of_death' =>  $this->date_of_death,
                'place_of_death' =>  $this->place_of_death,
                'coverage_type' =>  $this->coverage_type,
                'has_vehicle' =>  $this->has_vehicle,
                'amount' =>  $this->amount,
            ]);

            VehicleSchedule::create([
                'death_id' => $death->id,
                'schedule_first_name' => $this->schedule_first_name,
                'schedule_middle_name' => $this->schedule_middle_name,
                'schedule_last_name' => $this->schedule_last_name,
                'date_requested' => $this->date_requested,
                'scheduled_date' => $this->scheduled_date,
                'vehicle_type' => $this->vehicle_type,
                'remarks' => $this->remarks,
            ]);

            //save Files from fileupload
            foreach($this->attachment as $document){
            $death->death_attachments()->create(
                [
                    "path"=>$document->storeAs('public',now()->format("HismdY-").$document->getClientOriginalName()),
                                    "document_name"=>$document->getClientOriginalName(),
                ]
            );
            }

            DB::commit();
        }else{
            DB::beginTransaction();
            $death = Death::create([
                'member_id' => $this->global_member_id,
                'mortuary_id' => $this->mortuary_id,
                'batch_number' => $this->batch_number,
                'date' => $this->date,
                'enrollment_status' => $this->enrollment_status,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'dependents_first_name' => $this->dependents_first_name,
                'dependents_middle_name' => $this->dependents_middle_name,
                'dependents_last_name' => $this->dependents_last_name,
                'dependent_type' =>  $this->dependent_type,
                'has_diamond_package' =>  $this->has_diamond_package,
                'birthday' =>  $this->birthday,
                'age' =>  $this->age,
                'contact_number' =>  $this->contact_number,
                'date_of_death' =>  $this->date_of_death,
                'place_of_death' =>  $this->place_of_death,
                'coverage_type' =>  $this->coverage_type,
                'has_vehicle' =>  $this->has_vehicle,
                'amount' =>  $this->amount,
            ]);
              //save Files from fileupload
              foreach($this->attachment as $document){
                $death->death_attachments()->create(
                    [
                         "path"=>$document->storeAs('public',now()->format("HismdY-").$document->getClientOriginalName()),
                        "document_name"=>$document->getClientOriginalName(),
                    ]
                );
            }
            DB::commit();
        }

        $this->closeModal();
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully saved'
        );

    }

    public function mount()
    {
        $url = 'https://darbcmembership.org/api/member-darbc-ids?status=1';
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $this->member_ids = collect($member_data);

        $this->date = now();

        $this->amount = 0;

        if (Death::count() > 0) {
            // get the latest record
            $latestData = Death::latest('created_at')->first();

            // check if today is Monday and the latest record was created on Sunday
            $isMonday = Carbon::today()->isMonday();
            $isOtherDay = !$latestData->created_at->isMonday();

            if ($isMonday && $isOtherDay) {
                // increment the batch number if it's a Monday and the latest record was created on Sunday
                $this->batch_number = $latestData->batch_number + 1;
            } else {
                // otherwise, use the latest batch number
                $this->batch_number = $latestData->batch_number;
            }
        } else {
            $this->batch_number = 1;
        }
    }

    public function render()
    {
        return view('livewire.forms.add-death');
    }
}
