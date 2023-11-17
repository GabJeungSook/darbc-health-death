<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReportHeader;

class AdditionalHealthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          ReportHeader::create([
            'report_id' => 1,
            'report_name' => 'Above 10k',
            'header' => 'Above 10K Daily Payment',
        ]);
        ReportHeader::create([
            'report_id' => 1,
            'report_name' => 'In-House',
            'header' => 'In-House',
        ]);
    }
}
