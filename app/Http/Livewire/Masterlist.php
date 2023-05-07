<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Tables\Actions\Position;
use App\Models\Member;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\Action;
use App\Models\HealthDeath;
use App\Models\Health;
use App\Models\Transmittal;
use App\Models\Payment;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use DB;

class Masterlist extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;
    public $addHealth = false;
    public $batch_number;
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

    public function getTableActions()
    {
        return [
                ViewAction::make()
                ->label('View Data')
                ->modalHeading('Member Summary Data')
                ->color('success')
                ->modalWidth('6xl')
                ->modalContent(fn ($record) => view('livewire.forms.view-summary-data', [
                    'record' => $record,
                ]))->visible(fn ($record) => $record->status == "PAID"),
                ActionGroup::make([
                    Action::make('transmitted')
                    ->icon('heroicon-o-arrow-right')
                    ->mountUsing(fn (Forms\ComponentContainer $form, Health $record) => $form->fill([
                        'batch_number' => $this->batch_number,
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
                                     "path"=>'public\\'.$document,
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
                        ->reactive(),
                        FileUpload::make('attachment')
                        ->enableOpen()
                        ->multiple()
                        ->preserveFilenames()
                        ->reactive()
                        // Forms\Components\Select::make('authorId')
                        //     ->label('Author')
                        //     ->options(Health::query()->pluck('id', 'id'))
                        //     ->required(),
                    ])->requiresConfirmation()->visible(fn ($record) => $record->status == "ENCODED"),
                    Action::make('paid')
                    ->icon('heroicon-o-cash')
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
                                     "path"=>'public\\'.$document,
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
                    ])->requiresConfirmation()->visible(fn ($record) => $record->status == "TRANSMITTED")
                ]),
        ];

    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('memberName')
                ->formatStateUsing(function ($record) {
                    return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) .'.' ;
                })
                ->label('MEMBERS NAME')
                ->formatStateUsing(function ($record) {
                    $url = 'https://darbc.org/api/member-information/'.$record->member_id;
                    $response = file_get_contents($url);
                    $member_data = json_decode($response, true);

                    $collection = collect($member_data['data']);

                    return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) .'.' ;
                }),
            TextColumn::make('patientName')
                ->label('DEPENDENT')
                ->formatStateUsing(function ($record) {
                    $url = 'https://darbc.org/api/member-information/'.$record->member_id;
                    $response = file_get_contents($url);
                    $member_data = json_decode($response, true);

                    $collection = collect($member_data['data']);
                    if($record->enrollment_status == 'member')
                    {
                        return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) .'.' ;
                    }else{
                        return strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) .'.' ;
                    }
                })
                ->searchable()
                ->sortable(),
            // TextColumn::make('contact_number')
            //     ->label('CONTACT NUMBER')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('age')
            //     ->label('AGE')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('enrollment_status')
            //     ->label('ENROLLMENT STATUS')
            //     ->formatStateUsing(function ($record) {
            //         if($record == 'member')
            //         {
            //             return 'M';
            //         }else{
            //             return 'D';
            //         }
            //     })
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('confinement_date_from')
            //     ->label('DATE OF CONFINEMENT FROM')
            //     ->date('F d, Y')
            //     ->searchable()
            //     ->sortable(),
            // TextColumn::make('confinement_date_to')
            //     ->label('DATE OF CONFINEMENT TO')
            //     ->searchable()
            //     ->date('F d, Y')
            //     ->sortable(),
            TextColumn::make('hospitals.name')
                ->label('HOSPITAL NAME')
                ->searchable()
                ->sortable(),
            // TextColumn::make('number_of_days')
            //     ->label('NUMBER OF DAYS')
            //     ->searchable()
            //     ->sortable(),
            TextColumn::make('amount')
                ->label('AMOUNT')
                ->searchable()
                ->sortable(),
                BadgeColumn::make('status')
                ->enum([
                    'ENCODED' => 'Encoded',
                    'TRANSMITTED' => 'Transmitted',
                    'PAID' => 'Paid',
                ])
                ->colors([
                    'primary' => 'ENCODED',
                    'warning' => 'TRANSMITTED',
                    'success' => 'PAID',
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

    public function redirectToHospital()
    {
        return redirect()->route('hospital');
    }

    public function closeModal()
    {
        $this->addHealth = false;
    }

    public function mount()
    {
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
