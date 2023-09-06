<?php

namespace App\Http\Livewire;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\Type;
use Filament\Tables;
use App\Models\Purpose;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\SupervisorCode;
use App\Models\CommunityRelation;
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
                   // 'darbc_id' => $this->getDarbcId($record->member_id),
                    'reference_number' =>$record->reference_number,
                    'first_name' =>$record->first_name,
                    'middle_name' =>$record->middle_name,
                    'last_name' =>$record->last_name,
                    'organization' =>$record->organization,
                    'contact_number' =>$record->contact_number,
                    'purpose_id' =>$record->purpose_id,
                    'type_id' =>$record->type_id,
                    'number_of_participants' =>$record->number_of_participants,
                    'status' =>$record->status,
                ]))
                ->action(function (CommunityRelation $record, array $data): void {
                    DB::beginTransaction();
                    $record->first_name = $data['first_name'];
                    $record->middle_name = $data['middle_name'];
                    $record->last_name = $data['last_name'];
                    $record->organization = $data['organization'];
                    $record->contact_number = $data['contact_number'];
                    $record->purpose_id = $data['purpose_id'];
                    $record->type_id = $data['type_id'];
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
                    Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('reference_number')->label('Ref. No.')
                        ->disabled()
                        ->visible(false)
                        ->reactive()
                        ->required(),
                        Forms\Components\TextInput::make('darbc_id')->label('DARBC ID')
                        ->reactive()
                        ->visible(false)
                        ->disabled()
                        ->required(),
                    ])->columns(1),
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
                    Forms\Components\Select::make('purpose_id')
                    ->label('Purpose')
                    ->options(Purpose::pluck('name', 'id'))
                    ->required()
                    ->reactive(),
                    Forms\Components\Select::make('type_id')
                    ->label('Type')
                    ->options(Type::pluck('name', 'id'))
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
            // TextColumn::make('reference_number')
            // ->label('Ref. No.')
            // ->searchable()
            // ->sortable(),
            TextColumn::make('memberName')
            ->label('NAME')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name) . ' ' . strtoupper($record->last_name) ;
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('organization')
            ->label('ORGANIZATION / ADDRESS')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->organization);
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('contact_number')
            ->label('CONTACT NUMBER')
            ->searchable()
            ->sortable(),
            TextColumn::make('community_purpose.name')
            ->label('PURPOSE')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->community_purpose->name);
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('community_type.name')
            ->label('TYPE')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->community_type->name);
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('number_of_participants')
            ->label('PARTICIPANTS')
            ->searchable()
            ->sortable(),
            TextColumn::make('status')
            ->label('STATUS')
            ->formatStateUsing(function ($record) {
                return strtoupper($record->status);
            })
            ->searchable()
            ->sortable(),
        ];
    }

    public function getDarbcId($member_id)
    {
        $url = 'https://darbcmembership.org/api/member-information/'.$member_id;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();

        $collection = collect($member_data['data']);
        return $collection['darbc_id'];
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

    public function redirectToManage()
    {
        return redirect()->route('manage-community-relation');
    }

    public function render()
    {
        return view('livewire.community-relations');
    }
}
