<?php

namespace App\Http\Livewire;

use DB;
use Closure;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Health;
use App\Models\Member;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Hospital;
use WireUi\Traits\Actions;
use App\Models\HealthDeath;
use App\Models\Transmittal;
use App\Models\SupervisorCode;
use Filament\Forms\Components;
use App\Models\InsuranceCoverage;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Actions\Position;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Masterlist extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;
    public $addHealth = false;
    public $member_ids;
    public $darbc_id;
    public $batch_number;
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
    public $insurance_coverage_member;
    public $insurance_coverage_dependent;
    public $supervisor_code;

    protected $listeners = ['close_modal'=> 'closeModal'];

    protected function getTableQuery(): Builder
    {
        return Health::query();
    }

    protected function getTableActionsPosition(): ?string
    {
        return Position::AfterCells;
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('status')
            ->options([
                'ENCODED' => 'Encoded',
                'TRANSMITTED' => 'Transmitted',
                'PAID' => 'Paid',
            ])
        ];
    }

    // protected function getTableBulkActions(): array
    // {
    //     return [
    //         BulkAction::make('transmit_multiple')
    //         ->label('Transmitted (Multiple)')
    //         ->icon('heroicon-o-arrow-right')
    //         ->color('warning')
    //         ->action(function (Collection $records): void {
    //             foreach($records as $record)
    //             {
    //                 DB::beginTransaction();
    //                 $health = Transmittal::create([
    //                     'health_id' => $record->id,
    //                     'batch_number' => $this->batch_number,
    //                     'date_transmitted' => now(),
    //                 ]);
    //                 $record->status = 'TRANSMITTED';
    //                 $record->save();
    //                 DB::commit();
    //             }

    //             $this->dialog()->success(
    //                 $title = 'Success',
    //                 $description = 'Data successfully saved'
    //             );
    //         })->deselectRecordsAfterCompletion()
    //     ];
    // }

    public function getTableActions()
    {
        return [
                Action::make('print_claim')
                ->label('Print Claim')
                ->icon('heroicon-o-printer')
                ->button()
                ->color('success')
                ->url(fn (Health $record): string => route('daily-claims-health', $record))
                ->openUrlInNewTab(),
                Action::make('delete')
                ->label('Delete')
                ->icon('heroicon-o-trash')
                ->button()
                ->color('danger')
                ->action(fn ($record) => $record->delete())
                ->requiresConfirmation()
                ->visible(fn ($record) => $record->status == 'ENCODED'),
                ActionGroup::make([
                    Action::make('view_data')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->url(fn (Health $record): string => route('view-health', $record))
                    ->openUrlInNewTab(),
                     Action::make('edit')
                     ->color('success')
                    ->icon('heroicon-o-pencil')
                    ->mountUsing(fn (Forms\ComponentContainer $form, Health $record) => $form->fill([
                         'batch_number' => $record->batch_number,
                         'darbc_id' => $this->getDarbcId($record->member_id),
                         'enrollment_status' => $record->enrollment_status,
                         'patients_first_name' => $record->first_name,
                         'patients_middle_name' => $record->middle_name,
                         'patients_last_name' => $record->last_name,
                         'contact_number' => $record->contact_number,
                         'age' => $record->age,
                         'date_of_confinement_from' => Carbon::parse($record->confinement_date_from)->format('F d, Y'),
                         'date_of_confinement_to' => Carbon::parse($record->confinement_date_to)->format('F d, Y'),
                         'hospital_id' => $record->hospital_id,
                         'number_of_days' => $record->number_of_days,
                         'amount' => $record->amount,
                         'transmittal_date' => $record->transmittals?->date_transmitted,
                         'payment_date' => $record->payments?->date_of_payment,
                    ]))->action(function (Health $record, array $data): void {
                        if($record->update_attempts == 2)
                        {
                            $this->dialog()->error(
                                $title = 'PERMISSION REQUIRED',
                                $description = 'Supervisor Code reqiured after 2 attempts.'
                            );
                        }else{
                            DB::beginTransaction();
                            $health = Health::where('id', $record->id)->first();
                            $health->enrollment_status = $data['enrollment_status'];
                            $health->first_name = $data['patients_first_name'];
                            $health->middle_name = $data['patients_middle_name'];
                            $health->last_name = $data['patients_last_name'];
                            $health->contact_number = $data['contact_number'];
                            $health->age = $data['age'];
                            $health->confinement_date_from = $data['date_of_confinement_from'];
                            $health->confinement_date_to = $data['date_of_confinement_to'];
                            $health->hospital_id = $data['hospital_id'];
                            $health->number_of_days = $data['number_of_days'];
                            $health->amount = $data['amount'];

                            if($health->status != 'ENCODED')
                            {
                                $health->transmittals()->update([
                                    'date_transmitted' => $data['transmittal_date'],
                                ]);
                            }

                            if($health->status === 'PAID')
                            {
                                $health->payments()->update([
                                    'date_of_payment' => $data['payment_date'],
                                ]);
                            }
                            $health->save();

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
                            Wizard\Step::make('Encoded')
                                ->schema([
                                    Card::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('batch_number')->label('Batch No.')
                                        ->disabled()
                                        ->required(),
                                        Forms\Components\TextInput::make('darbc_id')->label('DARBC ID')
                                        ->reactive()
                                        ->disabled(),
                                        Forms\Components\Select::make('enrollment_status')->label('Enrollment Status')
                                        ->options([
                                            'member' => 'M',
                                            'dependent' => 'D',
                                        ])
                                        ->reactive()
                                        ->afterStateUpdated(function ($set, $get, $state, $record) {
                                            $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                                            $response = Http::withOptions(['verify' => false])->get($url);
                                            $member_data = $response->json();
                                            // $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                                            // $response = file_get_contents($url);
                                            // $member_data = json_decode($response, true);

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
                                        Forms\Components\TextInput::make('patients_first_name')->label('First Name')->reactive()->required()
                                        ->disabled(fn ($get) => $get('enrollment_status') == 'member'),
                                        Forms\Components\TextInput::make('patients_middle_name')->label('Middle Name')->reactive()->disabled(fn ($get) => $get('enrollment_status') == 'member'),
                                        Forms\Components\TextInput::make('patients_last_name')->label('Last Name')->reactive()->required()->disabled(fn ($get) => $get('enrollment_status') == 'member'),
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
                                                $this->date_of_confinement_from = $state;
                                                $this->date_of_confinement_to = $get('date_of_confinement_to');
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
                                                $this->date_of_confinement_from = $get('date_of_confinement_from');
                                                $this->date_of_confinement_to = $state;
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
                            Wizard\Step::make('Transmittal')
                                ->schema([
                                    DatePicker::make('transmittal_date')->label('Date Transmitted')
                                    ->reactive()
                                ])->visible(fn ($record) => $record->status != 'ENCODED'),
                            Wizard\Step::make('Payment')
                                ->schema([
                                    DatePicker::make('payment_date')->label('Date Of Payment')
                                    ->reactive()
                                ])->visible(fn ($record) => $record->status == 'PAID'),
                        ])

                    ])->visible(fn ($record) => $record->update_attempts < 2),
                    Action::make('code')
                    ->label('Enter Supervisor Code')
                    ->icon('heroicon-o-code')
                    ->color('danger')
                    ->visible(fn ($record) => $record->update_attempts == 2)
                    ->action(function (Health $record, array $data): void {
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
                    ->mountUsing(fn (Forms\ComponentContainer $form, Health $record) => $form->fill([
                        'batch_number' => $this->batch_number,
                        'date_transmitted' =>now()
                    ]))
                    ->action(function (Health $record, array $data): void {
                        DB::beginTransaction();
                        $health = Transmittal::create([
                            'health_id' => $record->id,
                            'batch_number' => $this->batch_number,
                            'date_transmitted' => $data['date_transmitted'],
                        ]);

                          //save Files from fileupload
                        foreach($data['attachment'] as $document){
                            $health->attachments()->create(
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
                        // Forms\Components\Select::make('authorId')
                        //     ->label('Author')
                        //     ->options(Health::query()->pluck('id', 'id'))
                        //     ->required(),
                    ])->requiresConfirmation()->visible(fn ($record) => $record->status == "ENCODED"),
                    Action::make('paid')
                    ->icon('heroicon-o-cash')
                    ->color('success')
                    ->action(function (Health $record, array $data): void {
                        DB::beginTransaction();
                        $payment = Payment::create([
                            'health_id' => $record->id,
                            'date_of_payment' => $data['date_of_payment'],
                        ]);

                           //save Files from fileupload
                           foreach($data['attachment'] as $document){
                            $payment->payment_attachments()->create(
                                [
                                    "path"=>'public/'.$document,
                                    "document_name"=>$document,
                                ]
                            );
                        }

                        $record->status = 'PAID';
                        $record->save();
                        DB::commit();
                        $this->dialog()->success(
                            $title = 'Success',
                            $description = 'Data successfully saved'
                        );
                    })
                    ->form([
                        DatePicker::make('date_of_payment')->label('Date Of Payment')
                        ->reactive(),
                        FileUpload::make('attachment')
                        ->enableOpen()
                        ->multiple()
                        ->preserveFilenames()
                        ->reactive()
                    ])->requiresConfirmation()->visible(fn ($record) => $record->status == "TRANSMITTED" || $record->status == "UNPAID"),
                    Action::make('unpaid')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(function (Health $record, array $data): void {
                        DB::beginTransaction();
                        $record->status = 'UNPAID';
                        $record->save();
                        DB::commit();
                        $this->dialog()->success(
                            $title = 'Success',
                            $description = 'Data successfully saved'
                        );
                    })
                    ->requiresConfirmation()->visible(fn ($record) => $record->status == "TRANSMITTED")
                ]),
        ];

    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('created_at')
            ->label('Encoded Date')
            ->date('F d, Y'),
            TextColumn::make('memberName')
                // ->formatStateUsing(function ($record) {
                //     return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name);
                // })
                ->label('MEMBERS NAME')
                ->searchable(['first_name', 'last_name'])
                ->formatStateUsing(function ($record) {
                    $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                    $response = Http::withOptions(['verify' => false])->get($url);
                    $member_data = $response->json();

                    if( $member_data === null)
                    {
                        dd($member_data);
                    }else{
                        $collection = collect($member_data['data']);
                        return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) ;
                    }



                }),
            TextColumn::make('patientName')
                ->label('DEPENDENT')
                ->searchable(['first_name', 'last_name'])
                ->formatStateUsing(function ($record) {

                    if($record->enrollment_status == 'member')
                    {
                        $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                        $response = Http::withOptions(['verify' => false])->get($url);
                        $member_data = $response->json();

                        if( $member_data === null)
                        {
                            dd($member_data);
                        }else{
                            $collection = collect($member_data['data']);
                            return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) ;
                        }
                        // $collection = collect($member_data['data']);
                        // return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) ;
                    }else{
                        return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name);
                    }
                    //return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name);
                })
                ->sortable(),

            TextColumn::make('hospitals.name')
                ->label('HOSPITAL NAME')
                ->formatStateUsing(function ($record) {
                    return strtoupper($record->hospitals->name);
                })
                ->searchable()
                ->sortable(),
            TextColumn::make('confinement_date_from')
            ->label('Confinement Date From')
            ->date('F d, Y'),
            TextColumn::make('confinement_date_to')
            ->label('Confinement Date To')
            ->date('F d, Y'),
            // TextColumn::make('number_of_days')
            //     ->label('NUMBER OF DAYS')
            //     ->searchable()
            //     ->sortable(),
            TextColumn::make('amount')
                ->label('AMOUNT')
                ->formatStateUsing(function ($record) {
                    return   number_format($record->amount, 2, '.', ',');
                })
                ->searchable()
                ->sortable(),
                BadgeColumn::make('status')
                ->label('STATUS')
                ->enum([
                    'ENCODED' => 'ENCODED',
                    'TRANSMITTED' => 'TRANSMITTED',
                    'PAID' => 'PAID',
                    'UNPAID' => 'UNPAID',
                ])
                ->colors([
                    'primary' => 'ENCODED',
                    'warning' => 'TRANSMITTED',
                    'success' => 'PAID',
                    'danger' => 'UNPAID',
                ]),
            TextColumn::make('payments.date_of_payment')
                ->label('DATE PAID')
                ->searchable()
                ->sortable()
                ->date('F d, Y'),
        ];
    }

    public function redirectToInquiry()
    {
        return redirect()->route('inquiry');
    }

    public function redirectToReport()
    {
        return redirect()->route('report');
    }

    public function redirectToInsuranceCoverage()
    {
        return redirect()->route('insurance-coverage');
    }

    public function closeModal()
    {
        $this->addHealth = false;
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
        $this->form->fill();
        $this->insurance_coverage_member = InsuranceCoverage::where('category', 'MEMBER')->first();
        $this->insurance_coverage_dependent = InsuranceCoverage::where('category', 'DEPENDENT')->first();

        if (Health::count() > 0) {
            // get the latest record
            $latestData = Health::latest('created_at')->first();

            // check if today is Monday and the latest record was created on Sunday
            $isWednesday = Carbon::today()->isWednesday();
            $isNotWednesday = !$latestData->created_at->isWednesday();

            $isFriday = Carbon::today()->isFriday();
            $isNotFriday = !$latestData->created_at->isFriday();

            if (($isWednesday && $isNotWednesday) || ($isFriday && $isNotFriday)) {
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
        return view('livewire.masterlist');
    }
}
