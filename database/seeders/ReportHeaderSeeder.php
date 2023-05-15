<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReportHeader;

class ReportHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //HEALTH
         ReportHeader::create([
            'report_id' => 1,
            'report_name' => 'Health - Members & Dependent',
            'header' => 'Health - Members & Dependent',
        ]);
        ReportHeader::create([
            'report_id' => 1,
            'report_name' => 'Transmittals',
            'header' => 'Transmittals',
        ]);
         //DEATH
        ReportHeader::create([
           'report_id' => 2,
           'report_name' => 'Death - Members & Dependent',
           'header' => 'Death - Members & Dependent',
        ]);
        //MORTUARY
        ReportHeader::create([
            'report_id' => 4,
            'report_name' => 'Mortuary Benefits',
            'header' => 'Mortuary Benefits',
        ]);
        //CASH ADVANCE
        ReportHeader::create([
            'report_id' => 5,
            'report_name' => 'Cash Advances',
            'header' => 'Cash Advances',
        ]);
    }
}
