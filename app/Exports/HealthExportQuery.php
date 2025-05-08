<?php

namespace App\Exports;

use App\Models\Health;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;

class HealthExportQuery implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldAutoSize
{
     use Exportable;
    protected $encoded_date_from, $encoded_date_to, $date_from, $date_to, $status, $enrollment_status;
        /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($encoded_date_from, $encoded_date_to, $date_from, $date_to, $status, $enrollment_status)
    {
        $this->encoded_date_from = $encoded_date_from;
        $this->encoded_date_to = $encoded_date_to;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->status = $status;
        $this->enrollment_status = $enrollment_status;
    }

    public function query()
    {
        $query =  Health::when($this->date_from && $this->date_to, function ($query) {
            if ($this->date_from === $this->date_to) {
                $query->where('confinement_date_from', $this->date_from);
            } else {
                $query->whereBetween('confinement_date_from', [$this->date_from, $this->date_to])
                      ->whereBetween('confinement_date_to', [$this->date_from, $this->date_to]);
            }
        })
        ->when($this->encoded_date_from && $this->encoded_date_to, function ($query) {
            if ($this->encoded_date_from === $this->encoded_date_to) {
                $query->whereDate('created_at', $this->encoded_date_from);
            } else {
                $query->whereBetween(DB::raw('DATE(created_at)'), [$this->encoded_date_from, $this->encoded_date_to]);
            }
        })
        ->when(!empty($this->status), fn ($query) =>
            is_array($this->status)
                ? $query->whereIn('status', $this->status)
                : $query->where('status', $this->status)
        )
        ->when($this->enrollment_status, fn ($query) =>
            $query->where('enrollment_status', $this->enrollment_status)
        );

        return $query;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Batch Number',
            'Enrollment Status',
            'DARBC ID',
            'Member Name',
            'Dependent Name',
            'Age',
            'Date of Confinement From',
            'Date of Confinement To',
            'Hospital',
            'No. of Days',
            'Amount',
            'Status',
        ];
    }

    public function map($item): array
    {
        try {
            return [
                \Carbon\Carbon::parse($item->created_at)->format('F d, Y'),
                $item->batch_number,
                strtoupper($item->enrollment_status),
                $item->darbc_id,
                $item->member_name,
                $item->enrollment_status === "member"
                    ? "---"
                    : trim("{$item->last_name} {$item->first_name} {$item->middle_name}"),
                $item->age,
                \Carbon\Carbon::parse($item->confinement_date_from)->format('F d, Y'),
                \Carbon\Carbon::parse($item->confinement_date_to)->format('F d, Y'),
                optional($item->hospitals)->name,
                $item->number_of_days,
                $item->amount,
                $item->status,
            ];
        } catch (\Throwable $e) {
            dd($e->getMessage());
            // \Log::error('Mapping error: ' . );
            return [];
        }
    }

    public function chunkSize(): int
    {
        return 100; // adjust based on your memory capacity
    }

}
