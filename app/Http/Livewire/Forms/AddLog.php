<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Filament\Forms;
use App\Models\Member;
use App\Models\Log;
use App\Models\Hospital;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use DB;

class AddLog extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $member_ids;
    public $member_id;
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


    protected function getFormSchema(): array
    {
        return [
            Card::make()
            ->schema([
                Forms\Components\Select::make('member_id')->label('DARBC ID')
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
                    }elseif($state == 'dependent'){
                        $set('patients_first_name', null);
                        $set('patients_middle_name', null);
                        $set('patients_last_name', null);
                    }
                })
                ->searchable()
                ->getOptionLabelUsing(fn ($value): ?string => Member::find($value)?->member_id)->required(),
                Forms\Components\Select::make('enrollment_status')->label('Are you a')->disabled(fn ($get) => $this->member_id == null)
                ->options([
                    'member' => 'Member',
                    'dependent' => 'Dependent',
                ])
                ->reactive()
                ->afterStateUpdated(function ($set, $get, $state) {
                    $url = 'https://darbc.org/api/member-information/'.$get('member_id');
                    $response = file_get_contents($url);
                    $member_data = json_decode($response, true);

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
                Forms\Components\TextInput::make('patients_first_name')->label('First Name')->reactive()->disabled(fn ($get) => $this->member_id == null)->required(),
                Forms\Components\TextInput::make('patients_middle_name')->label('Middle Name')->disabled(fn ($get) => $this->member_id == null)->reactive(),
                Forms\Components\TextInput::make('patients_last_name')->label('Last Name')->disabled(fn ($get) => $this->member_id == null)->reactive()->required(),
            ])->visible(fn ($get) => $this->enrollment_status == 'member')->columns(3),
            Fieldset::make('Dependent\'s Name')
            ->schema([
                Forms\Components\TextInput::make('dependents_first_name')->label('First Name')->disabled(fn ($get) => $this->member_id == null)->reactive()->required(),
                Forms\Components\TextInput::make('dependents_middle_name')->label('Middle Name')->disabled(fn ($get) => $this->member_id == null)->reactive(),
                Forms\Components\TextInput::make('dependents_last_name')->label('Last Name')->disabled(fn ($get) => $this->member_id == null)->reactive()->required(),
            ])->visible(fn ($get) => $this->enrollment_status == 'dependent')->columns(3),
            Card::make()
            ->schema([
                Forms\Components\Select::make('hospital_id')->label('Hospital')
                ->disabled(fn ($get) => $this->member_id == null)
                ->options(Hospital::all()->pluck('name', 'id'))
                ->required(),
                Forms\Components\TextInput::make('amount')
                ->reactive()
                ->disabled(fn ($get) => $this->member_id == null)
                ->required(),
                DatePicker::make('date_received')->label('Date Received')
                ->reactive()
                ->disabled(fn ($get) => $this->member_id == null)
                ->required()
            ])->columns(3)

        ];
    }

    public function closeModal()
    {
        $this->reset([
            'member_id','enrollment_status','patients_first_name',
            'patients_middle_name','patients_last_name', 'dependents_first_name',
            'dependents_middle_name','dependents_last_name',
            'hospital_id', 'amount', 'date_received'
        ]);
        $this->emit('close_modal');
    }

    public function save()
    {
        $this->validate([
            'member_id' => 'required',
            'enrollment_status' => 'required',
            'hospital_id' => 'required',
            'amount' => 'required',
            'date_received' => 'required',
        ], [
            'member_id.required' => 'Please select a DARBC ID!',
            'enrollment_status.required' => 'Please select an enrollment status!',
            'hospital_id.required' => 'Select a hospital.',
            'amount.required' => 'Please provide the amount!',
            'date_received' => 'Please provide the date received!',
        ]);


        if($this->enrollment_status == 'member')
        {
            DB::beginTransaction();
            Log::create([
                'member_id' => $this->member_id,
                'hospital_id' => $this->hospital_id,
                'enrollment_status' => $this->enrollment_status,
                'first_name' => $this->patients_first_name,
                'middle_name' => $this->patients_middle_name,
                'last_name' => $this->patients_last_name,
                'dependents_first_name' => $this->patients_first_name,
                'dependents_middle_name' => $this->patients_middle_name,
                'dependents_last_name' => $this->patients_last_name,
                'amount' => $this->amount,
                'date_received' => $this->date_received,
            ]);
            DB::commit();
        }else{
            $url = 'https://darbc.org/api/member-information/'.$this->member_id;
            $response = file_get_contents($url);
            $member_data = json_decode($response, true);

            $collection = collect($member_data['data']);

            DB::beginTransaction();
            Log::create([
                'member_id' => $this->member_id,
                'hospital_id' => $this->hospital_id,
                'enrollment_status' => $this->enrollment_status,
                'first_name' => $collection['user']['first_name'],
                'middle_name' => $collection['user']['middle_name'],
                'last_name' => $collection['user']['surname'],
                'dependents_first_name' => $this->dependents_first_name,
                'dependents_middle_name' => $this->dependents_middle_name,
                'dependents_last_name' => $this->dependents_last_name,
                'amount' => $this->amount,
                'date_received' => $this->date_received,
            ]);
            DB::commit();
        }



        $this->emit('close_modal');
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully saved'
        );
    }

    public function mount()
    {
        $url = 'https://darbc.org/api/member-darbc-ids?status=1';
        $response = file_get_contents($url);
        $member_data = json_decode($response, true);

        $this->member_ids = collect($member_data);
    }

    public function render()
    {
        return view('livewire.forms.add-log');
    }
}
