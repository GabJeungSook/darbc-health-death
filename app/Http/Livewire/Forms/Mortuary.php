<?php

namespace App\Http\Livewire\Forms;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use Livewire\Component;
use WireUi\Traits\Actions;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use App\Models\Mortuary as MortuaryModel;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class Mortuary extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $member_ids;
    public $member_full_names;
    public $full_name;
    public $darbc_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $contact_number;
    public $amount;
    public $date_of_death;
    public $place_of_death;
    public $hollographic;
    public $claimant_first_name;
    public $claimant_middle_name;
    public $claimant_last_name;
    public $claimant_contact_number;
    public $date_received;
    public $status;
    public $diamond_package;
    public $vehicle;
    public $coverage_type;
    public $attachment = [];

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('step_1')
                ->label('Step 1')
                ->schema([
                    Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('full_name')->label('DARBC Member')
                        ->reactive()
                        ->preload()
                        ->searchable()
                        ->options($this->member_full_names->pluck('full_name', 'id'))
                         ->afterStateUpdated(function ($set, $get, $state) {
                            $url = 'https://darbcrelease.org/api/member-information/'.$state;
                            $response = Http::withOptions(['verify' => false])->get($url);
                            $member_data = $response->json();

                            $collection = collect($member_data['data']);
                            $set('darbc_id', $collection['darbc_id']);
                            if($this->darbc_id != null)
                            {
                                $set('first_name', $collection['user']['first_name']);
                                $set('middle_name',$collection['user']['middle_name']);
                                $set('last_name', $collection['user']['surname']);
                                $set('contact_number', $collection['contact_number']);
                                $set('amount', 75640);
                                $set('hollographic',  $collection['holographic'] == true ? 'Yes' : 'No');
                            }else{
                                $set('first_name', null);
                                $set('middle_name', null);
                                $set('last_name', null);
                                $set('contact_number', null);
                                $set('amount', null);
                            }

                        }),
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
                    //         $set('amount', 75000);
                    //         $set('hollographic',  $collection['holographic'] == true ? 'Yes' : 'No');
                    //     }else{
                    //         $set('first_name', null);
                    //         $set('middle_name', null);
                    //         $set('last_name', null);
                    //         $set('contact_number', null);
                    //         $set('amount', null);
                    //     }

                    // })
                    // ->searchable()
                    // ->required(),
                    Fieldset::make('Member\'s Information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')->label('First Name')->reactive()->required(),
                        Forms\Components\TextInput::make('middle_name')->label('Middle Name')->reactive(),
                        Forms\Components\TextInput::make('last_name')->label('Last Name')->reactive()->required(),
                        Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('contact_number')->label('Contact Number')
                            ->numeric()
                            ->reactive(),
                            Forms\Components\TextInput::make('amount')->label('Amount')
                            ->numeric()
                            ->disabled()
                            ->reactive(),
                        ])->columns(2),
                        Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('hollographic')->label('Hollographic')
                            ->disabled()
                            ->reactive(),
                        ])->columns(1)
                    ])
                    ->columns(3),
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
                    ->required()
                ]),
                Wizard\Step::make('step_2')
                ->label('Step 2')
                ->schema([
                    Card::make()
                    ->schema([
                        Grid::make(2)
                        ->schema([
                            DatePicker::make('date_of_death')->label('Date Of Death')
                            ->reactive()
                            ->required(),
                            Forms\Components\TextInput::make('place_of_death')->label('Place Of Death')
                            ->reactive()
                            ->required(),
                        ]),
                        Forms\Components\Select::make('status')
                        ->options([
                            'Approved' => 'Approved',
                            'Pending' => 'Pending',
                        ])
                        ->required()
                        ->reactive(),
                        Forms\Components\Select::make('diamond_package')
                        ->label('Diamond Package (optional)')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No',
                            'Islam' => 'Islam',
                            'Distant' => 'Distant',
                        ])
                        ->reactive(),
                        Forms\Components\Select::make('vehicle')
                        ->label('Avail Vehicle')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No',
                        ])
                        ->required()
                        ->reactive(),
                        Grid::make(1)
                        ->schema([
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
                            ->required()
                        ])
                    ])->columns(3),
                    FileUpload::make('attachment')
                    ->enableOpen()
                    ->multiple()
                    ->disk('public')
                    ->preserveFilenames()
                    ->reactive()
                ]),
            ])

        ];
    }

    public function mount()
    {
        $url = 'https://darbc.org/api/member-darbc-names';
        $response = file_get_contents($url);
        $member_data = json_decode($response, true);

        $this->member_full_names = collect($member_data);


        // $url1 = 'https://darbc.org/api/member-darbc-ids?status=1';
        // $response1 = file_get_contents($url1);
        // $member_data1 = json_decode($response1, true);

        // $this->member_ids = collect($member_data1);
    }

    public function closeModal()
    {
        $this->reset([
            'darbc_id','contact_number','amount',
            'hollographic','claimant_first_name', 'claimant_middle_name',
            'claimant_last_name', 'claimant_contact_number', 'date_received', 'date_of_death', 'place_of_death', 'status',
            'diamond_package', 'vehicle'
        ]);
        $this->emit('close_mortuary_modal');
    }

    public function save()
    {
        $url = 'https://darbcrelease.org/api/member-information/'.$this->full_name;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $collection = collect($member_data['data']);

        $this->validate();
        DB::beginTransaction();
        $mortuary = MortuaryModel::create([
            'member_id' => $this->full_name,
            'member_name' => $collection['user']['full_name'],
            'contact_number' => $this->contact_number,
            'amount' => $this->amount,
            'date_of_death' => $this->date_of_death,
            'place_of_death' => $this->place_of_death,
            'hollographic' => $this->hollographic == 'Yes' ? 1 : 0,
            'claimants_first_name' => $this->claimant_first_name,
            'claimants_middle_name' => $this->claimant_middle_name,
            'claimants_last_name' => $this->claimant_last_name,
            'claimants_contact_number' => $this->claimant_contact_number,
            'date_received' => $this->date_received,
            'status' => $this->status,
            'diamond_package' => $this->diamond_package,
            'vehicle' => $this->vehicle,
            'coverage_type' => $this->coverage_type
        ]);
          //save Files from fileupload
          foreach($this->attachment as $document){
            $mortuary->mortuary_attachments()->create(
                [
                     "path"=>$document->storeAs('public',now()->format("HismdY-").$document->getClientOriginalName()),
                    "document_name"=>$document->getClientOriginalName(),
                ]
            );
        }
        DB::commit();
        $this->closeModal();
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Data successfully saved'
        );
        $this->emit('close_mortuary_modal');
    }

    public function render()
    {
        return view('livewire.forms.mortuary');
    }
}
