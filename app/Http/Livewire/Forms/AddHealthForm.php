<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Filament\Forms;
use App\Models\Member;
use App\Models\Health;
use App\Models\Hospital;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use DB;

class AddHealthForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $member_ids;
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

    protected function getFormSchema(): array
    {
        return [
            Card::make()
            ->schema([
                Forms\Components\TextInput::make('batch_number')->label('Batch No.')
                ->disabled()
                ->required(),
                Forms\Components\Select::make('darbc_id')->label('DARBC ID')
                ->reactive()
                ->options($this->member_ids->pluck('darbc_id', 'id'))
                ->afterStateUpdated(function ($set, $get, $state) {
                    $url = 'https://darbc.org/api/member-information/'.$state;
                    $response = file_get_contents($url);
                    $member_data = json_decode($response, true);

                    $collection = collect($member_data['data']);

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
                })
                ->searchable(),
                // ->getOptionLabelUsing(fn ($value): ?string => Member::find($value)?->member_id)->required(),
                Forms\Components\Select::make('enrollment_status')->label('Enrollment Status')->disabled(fn ($get) => $this->darbc_id == null)
                ->options([
                    'member' => 'M',
                    'dependent' => 'D',
                ])
                ->reactive()
                ->afterStateUpdated(function ($set, $get, $state) {
                    $url = 'https://darbc.org/api/member-information/'.$get('darbc_id');
                    $response = file_get_contents($url);
                    $member_data = json_decode($response, true);

                    $collection = collect($member_data['data']);

                   // $member = Member::where('member_id', $get('darbc_id'))->first();

                    $startDate = strtotime($get('date_of_confinement_from'));
                    $endDate = strtotime($get('date_of_confinement_to'));
                    $days = ($endDate - $startDate) / (60 * 60 * 24);

                    if($this->date_of_confinement_to != null)
                    {
                        if(Health::get()->count() == 0)
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
                             if(($totalDays + $days) < 30)
                             {
                                 if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                 {
                                     $set('number_of_days', 1);
                                 }else{
                                     $set('number_of_days', $days);
                                 }
                                 $amount = $get('number_of_days') * 1000;
                                 $set('amount', $amount);
                             }else{
                                 $excessDays = ($totalDays + $days) - 30;
                                 $remaining_days = 30 - $totalDays;
                                 $this->dialog()->info(
                                 $title = 'Information',
                                 $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed 30 days within this year.');
                                 $amount = $remaining_days * 1000;
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

                             if(($totalDays + $days) < 15)
                             {
                                 if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                 {
                                     $set('number_of_days', 1);
                                 }else{
                                     $set('number_of_days', $days);
                                 }
                                 $amount = $get('number_of_days') * 300;
                                 $set('amount', $amount);
                             }else{
                                 $excessDays = ($totalDays + $days) - 15;
                                 $remaining_days = 15 - $totalDays;
                                 $this->dialog()->info(
                                 $title = 'Information',
                                 $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed 15 days within this year.');
                                 $amount = $remaining_days * 300;
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

                               if(($totalDays + $days) < 30)
                               {
                                   if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                   {
                                       $set('number_of_days', 1);
                                   }else{
                                       $set('number_of_days', $days);
                                   }
                                   $amount = $get('number_of_days') * 1000;
                                   $set('amount', $amount);
                               }else{
                                   $excessDays = ($totalDays + $days) - 30;
                                   $remaining_days = 30 - $totalDays;
                                   $this->dialog()->info(
                                   $title = 'Information',
                                   $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed 30 days within this year.');
                                   $amount = $remaining_days * 1000;
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

                               if(($totalDays + $days) < 15)
                               {
                                   if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                   {
                                       $set('number_of_days', 1);
                                   }else{
                                       $set('number_of_days', $days);
                                   }
                                   $amount = $get('number_of_days') * 300;
                                   $set('amount', $amount);
                               }else{
                                   $excessDays = ($totalDays + $days) - 15;
                                   $remaining_days = 15 - $totalDays;
                                   $this->dialog()->info(
                                   $title = 'Information',
                                   $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed 15 days within this year.');
                                   $amount = $remaining_days * 300;
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

                                if(($totalDays + $days) < 30)
                                {
                                    if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                    {
                                        $set('number_of_days', 1);
                                    }else{
                                        $set('number_of_days', $days);
                                    }
                                    $amount = $get('number_of_days') * 1000;
                                    $set('amount', $amount);
                                }else{
                                    $excessDays = ($totalDays + $days) - 30;
                                    $remaining_days = 30 - $totalDays;
                                    $this->dialog()->info(
                                    $title = 'Information',
                                    $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed 30 days within this year.');
                                    $amount = $remaining_days * 1000;
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

                                if(($totalDays + $days) < 15)
                                {
                                    if($this->date_of_confinement_from === $this->date_of_confinement_to)
                                    {
                                        $set('number_of_days', 1);
                                    }else{
                                        $set('number_of_days', $days);
                                    }
                                    $amount = $get('number_of_days') * 300;
                                    $set('amount', $amount);
                                }else{
                                    $excessDays = ($totalDays + $days) - 15;
                                    $remaining_days = 15 - $totalDays;
                                    $this->dialog()->info(
                                    $title = 'Information',
                                    $description = 'Only '. $remaining_days .' day(s) will be covered in your insurance because you already consumed 15 days within this year.');
                                    $amount = $remaining_days * 300;
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



        ];
    }


    public function mount()
    {
        $url = 'https://darbc.org/api/member-darbc-ids?status=1';
        $response = file_get_contents($url);
        $member_data = json_decode($response, true);

        $this->member_ids = collect($member_data);

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
    }

    public function closeModal()
    {
        $this->reset([
            'darbc_id','enrollment_status','patients_first_name',
            'patients_middle_name','patients_last_name', 'contact_number',
            'age', 'date_of_confinement_from', 'date_of_confinement_to',
            'hospital_id', 'number_of_days', 'amount'
        ]);
        $this->emit('close_modal');
    }

    public function save()
    {
        $this->validate([
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
        Health::create([
            'member_id' => $this->darbc_id,
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
