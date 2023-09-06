<?php

namespace App\Http\Livewire;

use Filament\Tables;
use Livewire\Component;
use App\Models\Mortuary;
use Illuminate\Support\Facades\Http;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class MortuaryInquiry extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public $filters = [
        'member_id' => null,
        'contact_number' => null,
        'amount' => null,
        'hollographic' => null,
        'claimants_first_name' => null,
        'claimants_middle_name' => null,
        'claimants_last_name' => null,
        'claimants_contact_number' => null,
        'status' => null,
        'diamond_package' => null,
        'vehicle' => null,
        'coverage_type' => null,
    ];

    public $search = '';

    protected function getTableQuery(): Builder
    {
        return Mortuary::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('memberName')
            ->label('Member Name')
            ->formatStateUsing(function ($record) {
                $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                $response = Http::withOptions(['verify' => false])->get($url);
                $member_data = $response->json();
                // $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                // $response = file_get_contents($url);
                // $member_data = json_decode($response, true);

                $collection = collect($member_data['data']);

                return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']);
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('contact_number'),
            TextColumn::make('amount'),
            TextColumn::make('hollographic'),
            TextColumn::make('claimants_first_name'),
            TextColumn::make('claimants_middle_name'),
            TextColumn::make('claimants_last_name'),
            TextColumn::make('claimants_contact_number'),
            TextColumn::make('status'),
            TextColumn::make('diamond_package'),
            TextColumn::make('vehicle'),
            TextColumn::make('coverage_type')
        ];
    }

    public function redirectToMortuary()
    {
        return redirect()->route('mortuary');
    }

    public function render()
    {
        return view('livewire.mortuary-inquiry', [
            'records' => Mortuary::where(
                'member_id',
                'like',
                '%' . $this->search . '%'
            )
            ->orWhere('contact_number', 'like', '%' . $this->search . '%')
            ->orWhere('amount', 'like', '%' . $this->search . '%')
            ->orWhere('hollographic', 'like', '%' . $this->search . '%')
            ->orWhere('claimants_first_name', 'like', '%' . $this->search . '%')
            ->orWhere('claimants_middle_name', 'like', '%' . $this->search . '%')
            ->orWhere('claimants_last_name', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->orWhere('diamond_package', 'like', '%' . $this->search . '%')
            ->orWhere('vehicle', 'like', '%' . $this->search . '%')
            ->orWhere('coverage_type', 'like', '%' . $this->search . '%')
            ->get()
        ]);
    }
}
