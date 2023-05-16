<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use App\Models\CommunityRelation;
use App\Models\SupervisorCode;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Position;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use DB;

class CommunityRelations extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $addCommunityRelation = false;
    protected $listeners = ['close_community_modal'=> 'closeModal'];

    protected function getTableQuery(): Builder
    {
        return CommunityRelation::query();
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
            ->url(fn (CommunityRelation $record): string => route('view-community-relation', $record))
            ->openUrlInNewTab(),
            ActionGroup::make([
                Action::make('edit')
                ->icon('heroicon-o-pencil')
                ->button()
                ->color('primary')
                ->mountUsing(fn (Forms\ComponentContainer $form, CommunityRelation $record) => $form->fill([
                    'reference_number' =>$record->reference_number,
                    'first_name' =>$record->first_name,
                    'middle_name' =>$record->middle_name,
                    'last_name' =>$record->last_name,
                    'organization' =>$record->organization,
                    'contact_number' =>$record->contact_number,
                    'purpose' =>$record->purpose,
                    'type' =>$record->type,
                    'number_of_participants' =>$record->number_of_participants,
                    'status' =>$record->status,
                ]))
                ->action(function (CommunityRelation $record, array $data): void {
                    DB::beginTransaction();
                    $record->reference_number = $data['reference_number'];
                    $record->first_name = $data['first_name'];
                    $record->middle_name = $data['middle_name'];
                    $record->last_name = $data['last_name'];
                    $record->organization = $data['organization'];
                    $record->contact_number = $data['contact_number'];
                    $record->purpose = $data['purpose'];
                    $record->type = $data['type'];
                    $record->number_of_participants = $data['number_of_participants'];
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
                    Forms\Components\TextInput::make('reference_number')->label('Ref. No.')
                    ->disabled()
                    ->reactive()
                    ->required(),
                    Card::make()
                    ->schema([
                        Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('first_name')->label('First Name')->reactive()->required(),
                            Forms\Components\TextInput::make('middle_name')->label('Middle Name')->reactive(),
                            Forms\Components\TextInput::make('last_name')->label('Last Name')->reactive()->required(),
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
                        Forms\Components\TextInput::make('status')->label('Status')
                        ->reactive()
                        ->required(),
                    ])->columns(2)
                ])->visible(fn ($record) => $record->update_attempts < 2),
                Action::make('code')
                ->label('Enter Supervisor Code')
                ->icon('heroicon-o-code')
                ->color('danger')
                ->action(function (CommunityRelation $record, array $data): void {
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
            TextColumn::make('reference_number')
            ->label('Ref. No.')
            ->searchable()
            ->sortable(),
            TextColumn::make('memberName')
            ->label('Name')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) . ' ' . strtoupper($record->last_name) ;
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('organization')
            ->label('Organization / Address')
            ->searchable()
            ->sortable(),
            TextColumn::make('contact_number')
            ->label('Contact Number')
            ->searchable()
            ->sortable(),
            TextColumn::make('purpose')
            ->label('Purpose')
            ->searchable()
            ->sortable(),
            TextColumn::make('type')
            ->label('Type')
            ->searchable()
            ->sortable(),
            TextColumn::make('number_of_participants')
            ->label('Participants')
            ->searchable()
            ->sortable(),
            TextColumn::make('status')
            ->label('Status')
            ->searchable()
            ->sortable(),
        ];
    }

    public function closeModal()
    {
        $this->addCommunityRelation = false;
    }

    public function redirectToInquiry()
    {
        return redirect()->route('community-relation-inquiry');
    }

    public function redirectToReport()
    {
        return redirect()->route('community-relation-report');
    }

    public function render()
    {
        return view('livewire.community-relations');
    }
}
