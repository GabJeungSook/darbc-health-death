<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReportHeader;

class AdditionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //HEALTH
        ReportHeader::create([
            'report_id' => 1,
            'report_name' => 'Paid',
            'header' => 'Paid',
        ]);
        ReportHeader::create([
            'report_id' => 1,
            'report_name' => 'Encoded',
            'header' => 'Encoded',
        ]);
        ReportHeader::create([
            'report_id' => 1,
            'report_name' => 'Daily Claims',
            'header' => 'Daily Claims',
        ]);
        ReportHeader::create([
            'report_id' => 1,
            'report_name' => 'Below 10k',
            'header' => 'Below 10K Daily Payment',
        ]);
        //DEATH
        ReportHeader::create([
            'report_id' => 2,
            'report_name' => 'Daily Claims',
            'header' => 'Daily Claims',
        ]);
         //MORTUARY
         ReportHeader::create([
            'report_id' => 4,
            'report_name' => 'Daily Claims',
            'header' => 'Daily Claims',
        ]);
    }
}
