<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use App\Models\CashAdvance as CashAdvanceModel;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use WireUi\Traits\Actions;
use DB;

class CashAdvance extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $addCashAdvance = false;
    protected $listeners = ['close_cash_advance_modal'=> 'closeModal'];

    protected function getTableQuery(): Builder
    {
        return CashAdvanceModel::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('memberName')
            ->label('Member Name')
            ->formatStateUsing(function ($record) {
                $url = 'https://darbc.org/api/member-information/'.$record->member_id;
                $response = file_get_contents($url);
                $member_data = json_decode($response, true);

                $collection = collect($member_data['data']);

                return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) .'.' ;
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('purpose')
            ->label('Purpose')
            ->searchable()
            ->sortable(),
            TextColumn::make('account')
            ->label('Account')
            ->searchable()
            ->sortable(),
            TextColumn::make('amount_requested')
            ->label('Amount Requested')
            ->searchable()
            ->sortable(),
            TextColumn::make('date_received')
            ->label('Date Received')
            ->date('F d, Y')
            ->searchable()
            ->sortable(),
            BadgeColumn::make('status')
            ->enum([
                'On-going' => 'On-Going',
                'Pending' => 'Pending',
                'Approved' => 'Approved',
                'Disapproved' => 'Disapproved',
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

    public function render()
    {
        return view('livewire.cash-advance');
    }
}
