<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Collection;
use App\Models\VehicleSchedule;
use WireUi\Traits\Actions;
use Carbon\Carbon;

class ShowRecords extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;


    protected function getTableQuery(): Builder
    {
        return VehicleSchedule::query()->whereNotNull('scheduled_date');
    }

    protected function getTableFilters(): array
{
    return [
        Filter::make('scheduled_date')
        ->form([
            Forms\Components\DatePicker::make('created_from')->label('Scheduled Date From'),
            Forms\Components\DatePicker::make('created_until')->label('Scheduled Date Until')
            ])
        ->query(function (Builder $query, array $data): Builder {
            return $query
                ->when(
                    $data['created_from'],
                    fn (Builder $query, $date): Builder => $query->whereDate('scheduled_date', '>=', $date),
                )
                ->when(
                    $data['created_until'],
                    fn (Builder $query, $date): Builder => $query->whereDate('scheduled_date', '<=', $date),
                );
        })
        ->indicateUsing(function (array $data): array {
            $indicators = [];

            if ($data['created_from'] ?? null) {
                $indicators['created_from'] = 'Scheduled from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
            }

            if ($data['created_until'] ?? null) {
                $indicators['created_until'] = 'Scheduled until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
            }

            return $indicators;
        })
    ];
}

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('date_requested')
            ->label('Date Requested')
            ->date('F d, Y')
            ->sortable(),
            TextColumn::make('memberName')
            ->label('Member Name')
            ->formatStateUsing(function ($record) {
                $url = 'https://darbc.org/api/member-information/'.$record->deaths->member_id;
                $response = file_get_contents($url);
                $member_data = json_decode($response, true);

                $collection = collect($member_data['data']);

                return strtoupper($collection['user']['surname']) . ', ' . strtoupper($collection['user']['first_name']) . ' ' . strtoupper($collection['user']['middle_name']) .'.' ;
            })
            ->searchable()
            ->sortable(),
            TextColumn::make('scheduled_date')
            ->label('Schedule Date')
            ->date('F d, Y')
            ->sortable(),
            TextColumn::make('vehicle_type')
            ->label('Type of Vehicle')
            ->searchable()
            ->sortable(),
            TextColumn::make('remarks')
            ->label('Remarks')
            ->searchable()
            ->sortable(),

        ];
    }

    public function render()
    {
        return view('livewire.forms.show-records');
    }
}
