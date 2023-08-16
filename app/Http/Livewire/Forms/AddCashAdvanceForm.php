<?php

namespace App\Http\Livewire\Forms;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\CashAdvance;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;

class AddCashAdvanceForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $member_ids;
    public $member_full_names;
    public $full_name;
    public $darbc_id;
    public $enrollment_status;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $purpose;
    public $illness;
    public $other_purpose;
    public $contact_numbers = [];
    public $contact_number;
    public $account;
    public $amount_requested;
    public $amount_approved;
    public $date_received;
    public $date_approved;
    public $reason;
    public $status;

    protected function getFormSchema(): array
    {
        return [
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
                        $set('first_name', null);
                        $set('middle_name', null);
                        $set('last_name', null);
                        $set('purpose', null);
                        $set('illness', null);
                        $set('account', null);
                        $set('amount_requested', null);
                        $set('date_received', null);
                        $set('status', null);
                    }else{
                        $url = 'https://darbcrelease.org/api/member-information/'.$state;
                        $response = Http::withOptions(['verify' => false])->get($url);
                        $member_data = $response->json();

                        $collection = collect($member_data['data']);
                        $set('darbc_id', $collection['darbc_id']);

                        if($get('enrollment_status') == 'member')
                        {
                            $set('first_name', $collection['user']['first_name']);
                            $set('middle_name',$collection['user']['middle_name']);
                            $set('last_name', $collection['user']['surname']);
                        }else{
                            $set('first_name', null);
                            $set('middle_name', null);
                            $set('last_name', null);
                        }
                    }


                }),
            Grid::make(2)
            ->schema([
                Forms\Components\Select::make('enrollment_status')->label('Enrollment Status')->disabled(fn ($get) => $this->full_name == null)
                ->options([
                    'member' => 'Member',
                    'dependent' => 'Dependent',
                ])
                ->reactive()
                ->preload()
                ->afterStateUpdated(function ($set, $get, $state) {
                    $url = 'https://darbcrelease.org/api/member-information/'.$get('full_name');
                    $response = Http::withOptions(['verify' => false])->get($url);
                    $member_data = $response->json();

                    $collection = collect($member_data['data']);

                    if($state == 'member')
                    {
                        $set('first_name', $collection['user']['first_name']);
                        $set('middle_name',$collection['user']['middle_name']);
                        $set('last_name', $collection['user']['surname']);
                    }else{
                        $set('first_name', null);
                        $set('middle_name', null);
                        $set('last_name', null);
                    }

                })
                ->required(),
                Forms\Components\TextInput::make('darbc_id')->label('DARBC ID')
                ->disabled()
                ->reactive()
                ->required(),
            ]),
            // Forms\Components\Select::make('darbc_id')->label('DARBC ID')
            // ->reactive()
            // ->options($this->member_ids->pluck('darbc_id', 'id'))
            // ->afterStateUpdated(function ($set, $get, $state) {
            //     $url = 'https://darbcrelease.org/api/member-information/'.$state;
            //     $response = file_get_contents($url);
            //     $member_data = json_decode($response, true);

            //     $collection = collect($member_data['data']);

            //     if($this->darbc_id != null)
            //     {
            //         $set('first_name', $collection['user']['first_name']);
            //         $set('middle_name',$collection['user']['middle_name']);
            //         $set('last_name', $collection['user']['surname']);
            //         $set('contact_number', $collection['contact_number']);
            //     }else{
            //         $set('first_name', null);
            //         $set('middle_name', null);
            //         $set('last_name', null);
            //         $set('contact_number', null);
            //     }

            // })
            // ->searchable()
            // ->required(),
            Fieldset::make('Member\'s / Dependent\'s Information')
            ->schema([
                Forms\Components\TextInput::make('first_name')->label('First Name')->reactive()->required(),
                Forms\Components\TextInput::make('middle_name')->label('Middle Name')->reactive(),
                Forms\Components\TextInput::make('last_name')->label('Last Name')->reactive()->required(),
                Grid::make()
                ->schema([
                    Forms\Components\Select::make('purpose')->label('Purpose')
                    ->options([
                        'Hospitalization' => 'Hospitalization',
                        'Burial' => 'Burial',
                        'Maintenance' => 'Maintenance',
                        'School assistance / Tuition Fee' => 'School assistance / Tuition Fee',
                        'Others' => 'Others',
                    ])
                    ->reactive(),
                    Forms\Components\TextInput::make('illness')->label('Illness')->reactive(),
                    Forms\Components\Textarea::make('other_purpose')->label('State purpose')
                    ->reactive()
                    ->required()->visible(fn ($get) => $get('purpose') == "Others"),
                    Repeater::make('contact_numbers')
                    ->label('Contact Numbers')
                    ->schema([
                        Forms\Components\TextInput::make('contact_number')
                        ->numeric()
                        ->label('Contact')
                        ->required(),
                    ])->defaultItems(1)
                    ->createItemButtonLabel('Add Contact Number'),
                    Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('account')
                        ->required(),
                        Forms\Components\TextInput::make('amount_requested')
                        ->numeric()
                        ->label('Amount Requested')
                        ->required(),
                    ])

                ])->columns(1)
            ])
            ->columns(3),
            // Forms\Components\TextInput::make('purpose')
            // ->required(),

            Card::make()
            ->schema([
                Grid::make()
                ->schema([
                    Forms\Components\TextInput::make('amount_approved')
                    ->numeric()
                    ->label('Amount Approved')
                    ->required(),
                    Forms\Components\DatePicker::make('date_approved')
                    ->required(),
                ])->columns(1),
            ])->reactive()->visible(fn ($get) => $get('status') == "Approved"),

            Forms\Components\DatePicker::make('date_received')
            ->required(),
            Textarea::make('reason')
            ->required()
            ->reactive()
            ->visible(fn ($get) => $get('status') == "Pending" || $get('status') == "Disapproved"),
            Forms\Components\Select::make('status')
            ->options([
                'On-going' => 'On-going',
                'Pending' => 'Pending',
                'Approved' => 'Approved',
                'Disapproved' => 'Disapproved',
            ])
            ->default('On-going')
            ->disablePlaceholderSelection()
            ->reactive(),
        ];
    }


    public function mount()
    {
        $url = 'https://darbcrelease.org/api/member-darbc-names?status=1';
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $this->member_full_names = collect($member_data);

        $url1 = 'https://darbc.org/api/member-darbc-ids?status=1';
        $response1 = Http::withOptions(['verify' => false])->get($url1);
        $member_data1 = $response1->json();

        $this->member_ids = collect($member_data1);
        $this->form->fill();
    }

    public function closeModal()
    {
        $this->emit('close_cash_advance_modal');
        $this->reset(['full_name','darbc_id', 'enrollment_status', 'purpose', 'contact_number', 'account', 'amount_requested', 'amount_approved', 'date_received', 'date_approved', 'reason', 'status']);
    }

    public function save()
    {
        $this->validate();
        DB::beginTransaction();
        CashAdvance::create([
            'member_id' => $this->full_name,
            'enrollment_status' => $this->enrollment_status,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'purpose' => $this->purpose,
            'illness' => $this->illness,
            'other_purpose' => $this->other_purpose,
            'contact_numbers' => collect($this->contact_numbers)->values(),
            'account' => $this->account,
            'amount_requested' => $this->amount_requested,
            'amount_approved' => $this->amount_approved,
            'date_received' => $this->date_received,
            'date_approved' => $this->date_approved,
            'reason' => $this->reason,
            'status' => $this->status
        ]);
        DB::commit();
       $this->closeModal();
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully saved'
        );
    }

    public function render()
    {
        return view('livewire.forms.add-cash-advance-form');
    }
}
