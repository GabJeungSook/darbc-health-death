<?php

namespace Database\Seeders;

use App\Models\Signatory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdditionalReportHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

           //HEALTH ABOVE 10K
        Signatory::create([
            'report_header_id' => 28,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 28,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 28,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
            //HEALTH IN-HOUSE
            Signatory::create([
                'report_header_id' => 29,
                'name' => 'FUNNY C. BALENDES',
                'position' => 'Member Benefits-in-charge',
                'description' => 'Prepaid by'
            ]);
            Signatory::create([
                'report_header_id' => 29,
                'name' => 'JOHN EFFIE T. BELARMA',
                'position' => 'Membership Supervisor',
                'description' => 'Checked by'
            ]);
            Signatory::create([
                'report_header_id' => 29,
                'name' => 'MYTHEL FAITH S. MANLANGIT',
                'position' => 'CAD Department Head',
                'description' => 'Conformed by'
            ]);
    }
}
