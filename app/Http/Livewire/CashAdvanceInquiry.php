<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables;
use App\Models\CashAdvance;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;


class CashAdvanceInquiry extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public $filters = [
        'member_id' => null,
        'purpose' => null,
        'contact_number' => null,
        'account' => null,
        'amount_requested' => null,
        'amount_approved' => null,
        'date_received' => null,
        'date_approved' => null,
    ];

    public $search = '';

    protected function getTableQuery(): Builder
    {
        return CashAdvance::query();
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
            TextColumn::make('contact_number')
            ->label('Contact Number')
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
            TextColumn::make('amount_approved')
            ->label('Amount Approved')
            ->searchable()
            ->sortable(),
            TextColumn::make('amount_approved')
            ->label('Amount Approved')
            ->searchable()
            ->sortable(),
            TextColumn::make('date_received')
            ->label('Date Received')
            ->date('F d, y')
            ->searchable()
            ->sortable(),
            TextColumn::make('date_approved')
            ->label('Date Approved')
            ->date('F d, y')
            ->searchable()
            ->sortable(),
        ];
    }

    public function redirectToCashAdvance()
    {
        return redirect()->route('cash-advance');
    }

    public function render()
    {
        return view('livewire.cash-advance-inquiry', [
            'records' => CashAdvance::where(
                'member_id',
                'like',
                '%' . $this->search . '%'
            )
            ->orWhere('purpose', 'like', '%' . $this->search . '%')
            ->orWhere('account', 'like', '%' . $this->search . '%')
            ->orWhere('amount_requested', 'like', '%' . $this->search . '%')
            ->orWhere('amount_approved', 'like', '%' . $this->search . '%')
            ->orWhere('date_received', 'like', '%' . $this->search . '%')
            ->orWhere('date_approved', 'like', '%' . $this->search . '%')
            ->get()
        ]);
    }
}
