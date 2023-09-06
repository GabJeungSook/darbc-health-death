<?php

namespace App\Http\Livewire;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\SupervisorCode;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Http;
use Filament\Tables\Actions\Position;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\CashAdvance as CashAdvanceModel;

class CashAdvance extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $addCashAdvance = false;
    public $member_ids;
    public $darbc_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $purpose;
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
    protected $listeners = ['close_cash_advance_modal'=> 'closeModal'];

    protected function getTableQuery(): Builder
    {
        return CashAdvanceModel::query();
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
            ->url(fn (CashAdvanceModel $record): string => route('view-cash-advance', $record))
            ->openUrlInNewTab(),
            ActionGroup::make([
                Action::make('edit')
                ->icon('heroicon-o-pencil')
                ->button()
                ->color('primary')
                ->mountUsing(fn (Forms\ComponentContainer $form, CashAdvanceModel $record) => $form->fill([
                    'enrollment_status' => $record->enrollment_status,
                    'darbc_id' => $this->getDarbcId($record->member_id),
                    'first_name' => $record->first_name,
                    'middle_name' => $record->middle_name,
                    'last_name' => $record->last_name,
                    'purpose' => $record->purpose,
                    'other_purpose' => $record->other_purpose,
                    'contact_numbers' => $record->contact_numbers,
                    'account' => $record->account,
                    'amount_requested' => $record->amount_requested,
                    'amount_requested' => $record->amount_requested,
                    'amount_approved' => $record->amount_approved,
                    'date_approved' => $record->date_approved,
                    'date_received' => $record->date_received,
                    'reason' => $record->reason,
                    'status' =>  $record->status,
                ]))
                ->action(function (CashAdvanceModel $record, array $data): void {
                    DB::beginTransaction();
                        $record->member_id = $data['darbc_id'];
                        $record->enrollment_status = $data['enrollment_status'];
                        $record->first_name = $data['first_name'];
                        $record->middle_name = $data['middle_name'];
                        $record->last_name = $data['last_name'];
                        $record->purpose = $data['purpose'];
                        if($data['purpose'] != 'Others')
                        {
                            $record->other_purpose = null;
                        }else{
                            $record->other_purpose = $data['other_purpose'];
                        }
                        $record->contact_numbers = collect($data['contact_numbers'])->values();
                        $record->account = $data['account'];
                        $record->amount_requested = $data['amount_requested'];
                        if($data['status'] != 'Approved')
                        {
                            $record->amount_approved = null;
                            $record->date_approved = null;
                        }else{
                            $record->amount_approved = $data['amount_approved'];
                            $record->date_approved = $data['date_approved'];
                        }
                        $record->date_received = $data['date_received'];

                        if($data['status'] == 'Pending' || $data['status'] == 'Disapproved')
                        {
                            $record->reason = $data['reason'];
                        }else{
                            $record->reason = null;
                        }
                        $record->status = $data['status'];
                        $record->update_attempts = $record->update_attempts + 1;
                        $record->save();
                    DB::commit();
                    $this->dialog()->success(
                        $title = 'Success',
                        $description = 'Data successfully saved'
                    );
                })
                ->form([
                    Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('enrollment_status')->label('Enrollment Status')
                        ->options([
                            'member' => 'Member',
                            'dependent' => 'Dependent',
                        ])
                        ->reactive()
                        ->preload()
                        ->afterStateUpdated(function ($set, $get, $state, $record) {
                            $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                            $response = Http::withOptions(['verify' => false])->get($url);
                            $member_data = $response->json();

                            $collection = collect($member_data['data']);

                            if($state == 'member')
                            {
                                $set('first_name', $collection['user']['first_name']);
                                $set('middle_name',$collection['user']['middle_name']);
                                $set('last_name', $collection['user']['surname']);
                            }else{
                                $set('first_name', $record->first_name);
                                $set('middle_name', $record->middle_name);
                                $set('last_name', $record->last_name);
                            }

                        })
                        ->required(),
                        Forms\Components\TextInput::make('darbc_id')->label('DARBC ID')
                        ->reactive()
                        ->disabled()
                        ->required(),
                    ]),

                    Fieldset::make('Member\'s Information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')->label('First Name')->reactive()->disabled(fn ($get) => $get('enrollment_status') == 'member')->required(),
                        Forms\Components\TextInput::make('middle_name')->label('Middle Name')->reactive()->disabled(fn ($get) => $get('enrollment_status') == 'member'),
                        Forms\Components\TextInput::make('last_name')->label('Last Name')->reactive()->disabled(fn ($get) => $get('enrollment_status') == 'member')->required(),
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
                ])->visible(fn ($record) => $record->update_attempts < 2),
                Action::make('code')
                ->label('Enter Supervisor Code')
                ->icon('heroicon-o-code')
                ->color('danger')
                ->action(function (CashAdvanceModel $record, array $data): void {
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
            TextColumn::make('member_id')
            ->label('MEMBER NAME')
            ->formatStateUsing(function ($record) {
                $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                $response = Http::withOptions(['verify' => false])->get($url);
                $member_data = $response->json();

                $collection = collect($member_data['data']);

                return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']);
            })
            ->searchable(['first_name', 'last_name'])
            ->sortable(),
            TextColumn::make('first_name')
            ->label('DEPENDENTS NAME')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name);
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('purpose')
            ->label('PURPOSE')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->purpose);
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('account')
            ->label('ACCOUNT')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->account);
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('amount_requested')
            ->label('AMOUNT REQUESTED')
            ->searchable()
            ->formatStateUsing(function ($record) {
                return   number_format($record->amount_requested, 2, '.', ',');
            })
            ->sortable(),
            TextColumn::make('date_received')
            ->label('DATE RECEIVED')
            ->date('F d, Y')
            ->searchable()
            ->sortable(),
            BadgeColumn::make('status')
            ->label('STATUS')
            ->enum([
                'On-going' => 'ON-GOING',
                'Pending' => 'PENDING',
                'Approved' => 'APPROVED',
                'Disapproved' => 'DISAPPROVED',
            ])
            ->colors([
                'secondary' => 'On-going',
                'primary' => 'Pending',
                'success' => 'Approved',
                'danger' => 'Disapproved',
            ]),
        ];
    }

    public function redirectToInquiry()
    {
        return redirect()->route('cash-advance-inquiry');
    }

    public function redirectToReport()
    {
        return redirect()->route('cash-advance-report');
    }

    public function closeModal()
    {
        $this->addCashAdvance = false;
    }

    public function getDarbcId($member_id)
    {
        $url = 'https://darbcmembership.org/api/member-information/'.$member_id;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $collection = collect($member_data['data']);
        return $collection['darbc_id'];
    }

    public function getDarbcFirstName($member_id)
    {
        $url = 'https://darbcmembership.org/api/member-information/'.$member_id;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $collection = collect($member_data['data']);
        return $collection['user']['first_name'];
    }

    public function getDarbcMiddleName($member_id)
    {
        $url = 'https://darbcmembership.org/api/member-information/'.$member_id;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $collection = collect($member_data['data']);
        return $collection['user']['middle_name'];
    }

    public function getDarbcLastName($member_id)
    {
        $url = 'https://darbcmembership.org/api/member-information/'.$member_id;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $collection = collect($member_data['data']);
        return $collection['user']['surname'];
    }

    public function render()
    {
        return view('livewire.cash-advance');
    }
}
