<?php

namespace App\Http\Livewire\Forms;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\Health;
use App\Models\Member;
use Livewire\Component;
use App\Models\Hospital;
use WireUi\Traits\Actions;
use App\Models\InsuranceCoverage;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class AddHealthForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $member_ids;
    public $member_full_names;
    public $full_name;
    public $batch_number;
    public $darbc_id;
    public $enrollment_status;
    public $patients_first_name;
    public $patients_middle_name;
    public $patients_last_name;
    public $contact_number;
    public $age;
    public $date_of_confinement_from;
    public $date_of_confinement_to;
    public $hospital_id;
    public $number_of_days;
    public $amount;
    public $attachment = [];
    public $insurance_coverage_member;
    public $insurance_coverage_dependent;


    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Information')
                    ->schema([
                        Card::make()
                        ->schema([
                            Grid::make(1)
                            ->schema([
                                Forms\Components\Select::make('full_name')->label('DARBC Member')
                                ->reactive()
                                ->preload()
                                ->searchable()
                                ->options($this->member_full_names->pluck('full_name', 'id'))
                                ->afterStateUpdated(function ($set, $get, $state) {
                                    if($state == null)
                                        {
                                            $set('darbc_id', null);
                                            $set('enrollment_status', null);
                                            $set('patients_first_name', null);
                                            $set('patients_middle_name', null);
                                            $set('patients_last_name', null);
                                            $set('contact_number', null);
                                            $set('age', null);
                                            $set('date_of_confinement_from', null);
                                            $set('date_of_confinement_to', null);
                                            $set('hospital_id', null);
                                            $set('number_of_days', null);
                                            $set('amount', null);

                                        }else{
                                            $url = 'https://darbcmembership.org/api/member-information/'.$state;
                                            $response = Http::withOptions(['verify' => false])->get($url);
                                            $member_data = $response->json();

                                            $collection = collect($member_data['data']);
                                            $set('darbc_id', $collection['darbc_id']);
                                            //$member = Member::where('member_id', $state)->first();
                                            if($get('enrollment_status') == 'member')
                                            {

                                                $set('patients_first_name', $collection['user']['first_name']);
                                                $set('patients_middle_name',$collection['user']['middle_name']);
                                                $set('patients_last_name', $collection['user']['surname']);
                                                $set('contact_number', $collection['contact_number']);
                                                if($collection['date_of_birth'] != null)
                                                {
                                                    $date_of_birth = $collection['date_of_birth'];
                                                    $age = date_diff(date_create($date_of_birth), date_create('today'))->y;
                                                    $set('age', $age);
                                                }else{
                                                    $set('age', null);
                                                }
                                            }else{
                                                $set('patients_first_name', null);
                                                $set('patients_middle_name', null);
                                                $set('patients_last_name', null);
                                                $set('contact_number', null);
                                                $set('age', null);
                                            }
                                        }
                                })
                            ]),
                            Forms\Components\TextInput::make('batch_number')->label('Batch No.')
                            ->disabled()
                            ->required(),
                            Forms\Components\TextInput::make('darbc_id')->label('DARBC ID')
                            ->disabled()
                            ->reactive()
                            ->required(),
                            // Forms\Components\Select::make('darbc_id')->label('DARBC ID')
                            // ->reactive()
                            // ->options($this->member_ids->pluck('darbc_id', 'id'))
                            // ->afterStateUpdated(function ($set, $get, $state) {
                            //     if($state == null)
                            //     {
                            //         $set('emrollment_status', null);
                            //         $set('patients_first_name', null);
                            //         $set('patients_middle_name', null);
                            //         $set('patients_last_name', null);
                            //         $set('contact_number', null);
                            //         $set('age', null);
                            //         $set('date_of_confinement_from', null);
                            //         $set('date_of_confinement_to', null);
                            //         $set('hospital_id', null);
                            //         $set('number_of_days', null);
                            //         $set('amount', null);

                            //     }else{
                            //         $url = 'https://darbcmembership.org/api/member-information/'.$state;
                            //         $response = file_get_contents($url);
                            //         $member_data = json_decode($response, true);

                            //         $collection = collect($member_data['data']);

                            //         //$member = Member::where('member_id', $state)->first();
                            //         if($get('enrollment_status') == 'member')
                            //         {
                            //             $set('patients_first_name', $collection['user']['first_name']);
                            //             $set('patients_middle_name',$collection['user']['middle_name']);
                            //             $set('patients_last_name', $collection['user']['surname']);
                            //             $set('contact_number', $collection['contact_number']);
                            //             if($collection['date_of_birth'] != null)
                            //             {
                            //                 $date_of_birth = $collection['date_of_birth'];
                            //                 $age = date_diff(date_create($date_of_birth), date_create('today'))->y;
                            //                 $set('age', $age);
                            //             }else{
                            //                 $set('age', null);
                            //             }
                            //         }else{
                            //             $set('patients_first_name', null);
                            //             $set('patients_middle_name', null);
                            //             $set('patients_last_name', null);
                            //             $set('contact_number', null);
                            //             $set('age', null);
                            //         }
                            //     }

                            // })
                            // ->searchable(),
                            // ->getOptionLabelUsing(fn ($value): ?string => Member::find($value)?->member_id)->required(),
                            Forms\Components\Select::make('enrollment_status')->label('Enrollment Status')->disabled(fn ($get) => $this->full_name == null)
                            ->options([
                                'member' => 'Member',
                                'dependent' => 'Dependent',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function ($set, $get, $state) {
                                $url = 'https://darbcmembership.org/api/member-information/'.$get('full_name');
                                $response = Http::withOptions(['verify' => false])->get($url);
                                $member_data = $response->json();

                                $collection = collect($member_data['data']);

                               // $member = Member::where('member_id', $get('darbc_id'))->first();

                                $startDate = strtotime($get('date_of_confinement_from'));
                                $endDate = strtotime($get('date_of_confinement_to'));
                                $days = ($endDate - $startDate) / (60 * 60 * 24);

                                if($this->date_of_confinement_to != null)
                                {
                                    if(Health::where('member_id', $this->darbc_id)->get()->count() == 0)
                                    {
                                        $confinement_days = 0;
                                    }else{
                                        $confinement_days = Health::where('member_id', $this->darbc_id)->whereYear('confinement_date_from', $this->date_of_confinement_to)->first()->sum('number_of_days');
                                    }
                                }else{
                                    $confinement_days = null;
                                }


                                  //set amount computation
                                  if($get('enrollment_status') == 'member')
                                  {
                                        $set('patients_first_name', $collection['user']['first_name']);
                                        $set('patients_middle_name',$collection['user']['middle_name']);
                                        $set('patients_last_name', $collection['user']['surname']);
                                        $set('contact_number', $collection['contact_number']);
                                        if($collection['date_of_birth'] != null)
                                        {
                                            $date_of_birth = $collection['date_of_birth'];
                                            $age = date_diff(date_create($date_of_birth), date_create('today'))->y;
                                            $set('age', $age);
                                        }else{
                                            $set('age', null);
                                        }


                                     if ($this->date_of_confinement_to != null) {
                                         $year = date('Y', strtotime($this->date_of_confinement_to));

                                         if(Health::get()->count() == 0)
                                         {
                                            $totalDays = 0;
                                         }else{
                                            $totalDays = Health::where('member_id', $this->darbc_id)
                                            ->where('enrollment_status', 'member')
                                            ->whereYear('confinement_date_from', $year)
                                            ->sum('number_of_days');
                                         }
                                         if(($totalDays + $days) < $this->insurance_coverage_member->number_of_days)
                                         {
                                             if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                             {
                                                 $set('number_of_days', 1);
                                             }else{
                                                 $set('number_of_days', $days);
                                             }
                                             $amount = $get('number_of_days') * $this->insurance_coverage_member->amount;
                                             $set('amount', $amount);
                                         }else{
                                             $excessDays = ($totalDays + $days) - $this->insurance_coverage_member->number_of_days;
                                             $remaining_days = $this->insurance_coverage_member->number_of_days - $totalDays;
                                             $this->dialog()->info(
                                             $title = 'Information',
                                             $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed '.$this->insurance_coverage_member->number_of_days.' days within this year.');
                                             $amount = $remaining_days * $this->insurance_coverage_member->amount;
                                             $set('amount', $amount);
                                             $set('number_of_days', $days);
                                         }

                                        }



                                  }elseif($get('enrollment_status') == 'dependent')
                                  {
                                        $set('patients_first_name', null);
                                        $set('patients_middle_name', null);
                                        $set('patients_last_name', null);
                                        $set('contact_number', null);
                                        $set('age', null);

                                     if ($this->date_of_confinement_to != null) {
                                         $year = date('Y', strtotime($this->date_of_confinement_to));

                                         if(Health::get()->count() == 0)
                                         {
                                            $totalDays = 0;
                                         }else{
                                            $totalDays = Health::where('member_id', $this->darbc_id)
                                            ->where('enrollment_status', 'member')
                                            ->whereYear('confinement_date_from', $year)
                                            ->sum('number_of_days');
                                         }

                                         if(($totalDays + $days) < $this->insurance_coverage_dependent->number_of_days)
                                         {
                                             if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                             {
                                                 $set('number_of_days', 1);
                                             }else{
                                                 $set('number_of_days', $days);
                                             }
                                             $amount = $get('number_of_days') * $this->insurance_coverage_dependent->amount;
                                             $set('amount', $amount);
                                         }else{
                                             $excessDays = ($totalDays + $days) - $this->insurance_coverage_dependent->number_of_days;
                                             $remaining_days = $this->insurance_coverage_dependent->number_of_days - $totalDays;
                                             $this->dialog()->info(
                                             $title = 'Information',
                                             $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed '.$this->insurance_coverage_dependent->number_of_days.' days within this year.');
                                             $amount = $remaining_days * $this->insurance_coverage_dependent->amount;
                                             $set('amount', $amount);
                                             $set('number_of_days', $days);
                                         }

                                     }


                                  }
                            })
                            ->required(),
                        ])->columns(3),

                        Fieldset::make('Patient\'s Information')
                        ->schema([
                            Forms\Components\TextInput::make('patients_first_name')->label('First Name')->reactive()->required(),
                            Forms\Components\TextInput::make('patients_middle_name')->label('Middle Name')->reactive(),
                            Forms\Components\TextInput::make('patients_last_name')->label('Last Name')->reactive()->required(),
                            Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('contact_number')->label('Contact Number')->reactive()->required(),
                                Forms\Components\TextInput::make('age')->reactive()->required(),
                            ]) ->columns(2)
                        ])
                        ->columns(3),
                        Fieldset::make('Confinement Information')
                        ->schema([
                            Grid::make()
                            ->schema([
                                DatePicker::make('date_of_confinement_from')->label('From')
                                ->reactive()
                                ->afterStateUpdated(function ($set, $get, $state){
                                    if(($state != null && $get('date_of_confinement_to') != null) && $state <= $get('date_of_confinement_to'))
                                    {
                                        $startDate = strtotime($state);
                                        $endDate = strtotime($get('date_of_confinement_to'));

                                        $days = ($endDate - $startDate) / (60 * 60 * 24);

                                        //set amount computation
                                        if($get('enrollment_status') == 'member')
                                        {
                                           if ($this->date_of_confinement_to != null) {
                                               $year = date('Y', strtotime($this->date_of_confinement_to));

                                               $totalDays = Health::where('member_id', $this->darbc_id)
                                                   ->where('enrollment_status', 'member')
                                                   ->whereYear('confinement_date_from', $year)
                                                   ->sum('number_of_days');
                                           }

                                           if(($totalDays + $days) < $this->insurance_coverage_member->number_of_days)
                                           {
                                               if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                               {
                                                   $set('number_of_days', 1);
                                               }else{
                                                   $set('number_of_days', $days);
                                               }
                                               $amount = $get('number_of_days') * $this->insurance_coverage_member->amount;
                                               $set('amount', $amount);
                                           }else{
                                               $excessDays = ($totalDays + $days) - $this->insurance_coverage_member->number_of_days;
                                               $remaining_days = $this->insurance_coverage_member->number_of_days - $totalDays;
                                               $this->dialog()->info(
                                               $title = 'Information',
                                               $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed '.$this->insurance_coverage_member->number_of_days.' days within this year.');
                                               $amount = $remaining_days * $this->insurance_coverage_member->amount;
                                               $set('amount', $amount);
                                               $set('number_of_days', $days);
                                           }

                                        }elseif($get('enrollment_status') == 'dependent')
                                        {

                                           if ($this->date_of_confinement_to != null) {
                                               $year = date('Y', strtotime($this->date_of_confinement_to));

                                               $totalDays = Health::where('member_id', $this->darbc_id)
                                                   ->where('enrollment_status', 'dependent')
                                                   ->whereYear('confinement_date_from', $year)
                                                   ->sum('number_of_days');
                                           }

                                           if(($totalDays + $days) < $this->insurance_coverage_dependent->number_of_days)
                                           {
                                               if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                               {
                                                   $set('number_of_days', 1);
                                               }else{
                                                   $set('number_of_days', $days);
                                               }
                                               $amount = $get('number_of_days') * $this->insurance_coverage_dependent->amount;
                                               $set('amount', $amount);
                                           }else{
                                               $excessDays = ($totalDays + $days) - $this->insurance_coverage_dependent->number_of_days;
                                               $remaining_days = $this->insurance_coverage_dependent->number_of_days - $totalDays;
                                               $this->dialog()->info(
                                               $title = 'Information',
                                               $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed '.$this->insurance_coverage_dependent->number_of_days.' days within this year.');
                                               $amount = $remaining_days * $this->insurance_coverage_dependent->amount;
                                               $set('amount', $amount);
                                               $set('number_of_days', $days);
                                           }
                                        }
                                    }elseif($state > $get('date_of_confinement_to')){
                                        $set('number_of_days', 0);
                                        $set('amount', 0);
                                    }else{
                                        $set('number_of_days', 0);
                                        $set('amount', 0);
                                    }
                                })
                                ->required(),
                                DatePicker::make('date_of_confinement_to')->label('To')
                                ->reactive()
                                ->afterStateUpdated(function ($set, $get, $state){
                                    if(($get('date_of_confinement_from') != null && $state != null) && $get('date_of_confinement_from') <= $state)
                                    {
                                        $startDate = strtotime($get('date_of_confinement_from'));
                                        $endDate = strtotime($state);

                                        $days = ($endDate - $startDate) / (60 * 60 * 24);


                                        //set amount computation
                                         if($get('enrollment_status') == 'member')
                                         {
                                            if ($this->date_of_confinement_to != null) {
                                                $year = date('Y', strtotime($this->date_of_confinement_to));

                                                $totalDays = Health::where('member_id', $this->darbc_id)
                                                    ->where('enrollment_status', 'member')
                                                    ->whereYear('confinement_date_from', $year)
                                                    ->sum('number_of_days');
                                            }

                                            if(($totalDays + $days) < $this->insurance_coverage_member->number_of_days)
                                            {
                                                if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                                {
                                                    $set('number_of_days', 1);
                                                }else{
                                                    $set('number_of_days', $days);
                                                }
                                                $amount = $get('number_of_days') * $this->insurance_coverage_member->amount;
                                                $set('amount', $amount);
                                            }else{
                                                $excessDays = ($totalDays + $days) - $this->insurance_coverage_member->number_of_days;
                                                $remaining_days = $this->insurance_coverage_member->number_of_days - $totalDays;
                                                $this->dialog()->info(
                                                $title = 'Information',
                                                $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed '.$this->insurance_coverage_member->number_of_days.' days within this year.');
                                                $amount = $remaining_days * $this->insurance_coverage_member->amount;
                                                $set('amount', $amount);
                                                $set('number_of_days', $days);
                                            }

                                         }elseif($get('enrollment_status') == 'dependent')
                                         {

                                            if ($this->date_of_confinement_to != null) {
                                                $year = date('Y', strtotime($this->date_of_confinement_to));

                                                $totalDays = Health::where('member_id', $this->darbc_id)
                                                    ->where('enrollment_status', 'dependent')
                                                    ->whereYear('confinement_date_from', $year)
                                                    ->sum('number_of_days');
                                            }

                                            if(($totalDays + $days) < $this->insurance_coverage_dependent->number_of_days)
                                            {
                                                if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                                {
                                                    $set('number_of_days', 1);
                                                }else{
                                                    $set('number_of_days', $days);
                                                }
                                                $amount = $get('number_of_days') * $this->insurance_coverage_dependent->amount;
                                                $set('amount', $amount);
                                            }else{
                                                $excessDays = ($totalDays + $days) - $this->insurance_coverage_dependent->number_of_days;
                                                $remaining_days = $this->insurance_coverage_dependent->number_of_days - $totalDays;
                                                $this->dialog()->info(
                                                $title = 'Information',
                                                $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed '.$this->insurance_coverage_dependent->number_of_days.' days within this year.');
                                                $amount = $remaining_days * $this->insurance_coverage_dependent->amount;
                                                $set('amount', $amount);
                                                $set('number_of_days', $days);
                                            }
                                         }
                                    }elseif($get('date_of_confinement_from') > $state){
                                        $set('number_of_days', 0);
                                        $set('amount', 0);
                                    }else{
                                        $set('number_of_days', 0);
                                        $set('amount', 0);
                                    }
                                })
                                ->required(),
                                Forms\Components\Select::make('hospital_id')->label('Hospital')->searchable()
                                ->options(Hospital::all()->pluck('name', 'id'))
                                ->required(),
                                Forms\Components\TextInput::make('number_of_days')->label('Number Of Days')->default('0')->disabled()
                                ->reactive()
                                ->required(),
                            ])->columns(2),
                            Forms\Components\TextInput::make('amount')
                            ->reactive()
                            ->disabled()
                            ->required(),
                        ])->columns(1),
                    ]),
                Wizard\Step::make('Attachments')
                    ->schema([
                        FileUpload::make('attachment')
                        ->enableOpen()
                        ->multiple()
                        ->disk('public')
                        ->preserveFilenames()
                        ->reactive()
                    ])
            ])

        ];
    }


    public function mount()
    {
        $url = 'https://darbcmembership.org/api/member-darbc-names?status=1';
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        // $this->member_ids = collect($member_data);

        // $url1 = 'https://darbc.org/api/member-darbc-ids?status=1';
        // $response1 = file_get_contents($url1);
        // $member_data1 = json_decode($response1, true);

        // $this->member_ids = collect($member_data1);
       $this->member_full_names = collect($member_data);

        if (Health::count() > 0) {
            // get the latest record
            $latestData = Health::latest('created_at')->first();

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

        $this->insurance_coverage_member = InsuranceCoverage::where('category', 'MEMBER')->first();
        $this->insurance_coverage_dependent = InsuranceCoverage::where('category', 'DEPENDENT')->first();
    }

    public function closeModal()
    {
        $this->reset([
            'full_name','darbc_id','enrollment_status','patients_first_name',
            'patients_middle_name','patients_last_name', 'contact_number',
            'age', 'date_of_confinement_from', 'date_of_confinement_to',
            'hospital_id', 'number_of_days', 'amount'
        ]);
        $this->emit('close_modal');
    }

    public function save()
    {
        $this->validate([
            'full_name' => 'required',
            'darbc_id' => 'required',
            'enrollment_status' => 'required',
            'patients_first_name' => 'required',
            'patients_last_name' => 'required',
            'contact_number' => 'required',
            'age' => 'required',
            'date_of_confinement_from' => 'required|date',
            'date_of_confinement_to' => 'required|date|after:date_of_confinement_from',
            'hospital_id' => 'required',
            'number_of_days' => 'required',
            'amount' => 'required',
        ], [
            'full_name.required' => 'Please select a DARBC Member',
            'darbc_id.required' => 'Please select a DARBC ID!',
            'enrollment_status.required' => 'Please select an enrollment status!',
            'patients_first_name.required' => 'Please provide the patient\'s first name!',
            'patients_last_name.required' => 'Please provide the patient\'s last name!',
            'contact_number.required' => 'Please provide a contact number!',
            'age.required' => 'Please provide the patient\'s age!',
            'date_of_confinement_from.required' => 'Please provide the date of confinement (from)!',
            'date_of_confinement_to.required' => 'Please provide the date of confinement (to)!',
            'date_of_confinement_from.date' => 'The date of confinement (from) is invalid!',
            'date_of_confinement_to.date' => 'The date of confinement (to) is invalid!',
            'date_of_confinement_to.after' => 'The date of confinement (to) must be after the date of confinement (from)!',
            'hospital_id.required' => 'Select a hospital.',
            'number_of_days.required' => 'Please provide the number of days!',
            'amount.required' => 'Please provide the amount!',
        ]);

        DB::beginTransaction();
        $health = Health::create([
            'member_id' => $this->full_name,
            'hospital_id' => $this->hospital_id,
            'batch_number' => $this->batch_number,
            'enrollment_status' => $this->enrollment_status,
            'first_name' => $this->patients_first_name,
            'middle_name' => $this->patients_middle_name,
            'last_name' => $this->patients_last_name,
            'contact_number' => $this->contact_number,
            'age' => $this->age,
            'confinement_date_from' => $this->date_of_confinement_from,
            'confinement_date_to' => $this->date_of_confinement_to,
            'number_of_days' => $this->number_of_days,
            'amount' => $this->amount,
            'status' => 'ENCODED',
        ]);
            //save Files from fileupload
            foreach($this->attachment as $document){
                $health->health_attachments()->create(
                    [
                         "path"=>$document->storeAs('public',now()->format("HismdY-").$document->getClientOriginalName()),
                        "document_name"=>$document->getClientOriginalName(),
                    ]
                );
            }
        DB::commit();

        $this->emit('close_modal');
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully saved'
        );
    }



    public function render()
    {
        return view('livewire.forms.add-health-form');
    }
}
