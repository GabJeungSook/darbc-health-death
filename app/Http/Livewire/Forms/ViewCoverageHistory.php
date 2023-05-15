<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Filament\Tables;
use App\Models\CoverageHistory;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Carbon\Carbon;

class ViewCoverageHistory extends Component  implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return CoverageHistory::query()->orderBy('id', 'desc');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('amount')
            ->label('Amount'),
            TextColumn::make('number_of_days')
            ->label('Number Of Days'),
            TextColumn::make('category')
            ->label('Category')
            ->sortable(),
            TextColumn::make('created_at')
            ->label('Date Implemented')
            ->date('F d, Y H:i:s A'),
        ];
    }


    public function render()
    {
        return view('livewire.forms.view-coverage-history');
    }
}
