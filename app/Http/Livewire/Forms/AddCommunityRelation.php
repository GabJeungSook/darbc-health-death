<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Filament\Forms;
use App\Models\CommunityRelation;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use DB;

class AddCommunityRelation extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;


    public $member_ids;
    public $darbc_id;
    public $reference_number;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $organization;
    public $contact_number;
    public $purpose;
    public $type;
    public $number_of_participants;
    public $status;

    protected function getFormSchema(): array
    {
        return [
            Grid::make()
            ->schema([
                Forms\Components\TextInput::make('reference_number')->label('Ref. No.')
                ->disabled()
                ->reactive()
                ->required(),
                Forms\Components\Select::make('darbc_id')->label('DARBC ID')
                ->reactive()
                ->options($this->member_ids->pluck('darbc_id', 'id'))
                ->afterStateUpdated(function ($set, $get, $state) {
                    $url = 'https://darbc.org/api/member-information/'.$state;
                    $response = file_get_contents($url);
                    $member_data = json_decode($response, true);

                    $collection = collect($member_data['data']);

                    if($this->darbc_id != null)
                    {
                        $set('first_name', $collection['user']['first_name']);
                        $set('middle_name',$collection['user']['middle_name']);
                        $set('last_name', $collection['user']['surname']);
                        $set('contact_number', $collection['contact_number']);
                    }else{
                        $set('first_name', null);
                        $set('middle_name', null);
                        $set('last_name', null);
                        $set('contact_number', null);
                    }
                })
                ->searchable()
                ->required(),
            ])->columns(2),
            Card::make()
            ->schema([
                Grid::make()
                ->schema([
                    Forms\Components\TextInput::make('first_name')->label('First Name')->reactive()->disabled()->required(),
                    Forms\Components\TextInput::make('middle_name')->label('Middle Name')->reactive()->disabled(),
                    Forms\Components\TextInput::make('last_name')->label('Last Name')->reactive()->disabled()->required(),
                ])->columns(3),
                Grid::make()
                ->schema([
                    Forms\Components\TextInput::make('organization')->label('Organization / Address')->reactive()->required(),
                    Forms\Components\TextInput::make('contact_number')->label('Contact Number')->numeric()->reactive(),
                ])->columns(2)

            ]),
            Forms\Components\Select::make('purpose')
            ->options([
                'Medical Assistance' => 'Medical Assistance',
                'Community/Event Sponsorship' => 'Community/Event Sponsorship',
                'School Assistance' => 'School Assistance',
                'Church Assistance' => 'Church Assistance',
                'General Assembly' => 'General Assembly',
            ])
            ->required()
            ->reactive(),
            Forms\Components\Select::make('type')
            ->options([
                'Cash' => 'Cash',
                'Coupon' => 'Coupon',
                'Item' => 'Item',
            ])
            ->required()
            ->reactive(),
            Grid::make()
            ->schema([
                Forms\Components\TextInput::make('number_of_participants')->label('Number of Participants')
                ->numeric()
                ->reactive()
                ->required(),
                Forms\Components\Select::make('status')
                ->options([
                    'On-going' => 'On-going',
                    'Pending' => 'Pending',
                    'Approved' => 'Approved',
                    'Disapproved' => 'Disapproved',
                ])
                ->reactive(),
            ])->columns(2)
        ];
    }

    public function mount()
    {
        $url = 'https://darbc.org/api/member-darbc-ids?status=1';
        $response = file_get_contents($url);
        $member_data = json_decode($response, true);

        $this->member_ids = collect($member_data);

        if (CommunityRelation::count() > 0) {
            // get the latest record
            $latestData = CommunityRelation::latest('created_at')->first();

            // check if today is Monday and the latest record was created on Sunday
            $isMonday = Carbon::today()->isMonday();
            $isOtherDay = !$latestData->created_at->isMonday();

            if ($isMonday && $isOtherDay) {
                // increment the batch number if it's a Monday and the latest record was created on Sunday
                $this->reference_number = $latestData->reference_number + 1;
            } else {
                // otherwise, use the latest batch number
                $this->reference_number = $latestData->reference_number;
            }
        } else {
            $this->reference_number = 1;
        }
    }

    public function closeModal()
    {
        $this->emit('close_community_modal');
        $this->reset(
            [
            'darbc_id',
            'reference_number',
            'first_name',
            'middle_name',
            'last_name',
            'organization',
            'contact_number',
            'purpose',
            'type',
            'number_of_participants',
            'status'
        ]
    );
    }



    public function save()
    {
        $this->validate();
        DB::beginTransaction();
        CommunityRelation::create([
            'member_id' =>  $this->darbc_id,
            'reference_number' => $this->reference_number,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'organization' => $this->organization,
            'contact_number' => $this->contact_number,
            'purpose' => $this->purpose,
            'type' => $this->type,
            'number_of_participants' => $this->number_of_participants,
            'status' => $this->status,
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
        return view('livewire.forms.add-community-relation');
    }
}
