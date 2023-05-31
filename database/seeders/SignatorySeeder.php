<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Signatory;

class SignatorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          //HEALTH
          Signatory::create([
            'report_header_id' => 1,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 1,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 1,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
         //HEALTH TRANSMITTALS
         Signatory::create([
            'report_header_id' => 2,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 2,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 2,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
        //HEALTH PAID
        Signatory::create([
            'report_header_id' => 7,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 7,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 7,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
        //HEALTH ENCODED
        Signatory::create([
            'report_header_id' => 8,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 8,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 8,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
        //HEALTH DAILY CLAIMS
        Signatory::create([
            'report_header_id' => 9,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 9,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 9,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
        //HEALTH BELOW 10K
        Signatory::create([
            'report_header_id' => 10,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 10,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 10,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
         //DEATH
         Signatory::create([
            'report_header_id' => 3,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 3,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 3,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
         //DEATH DAILY CLAIMS
         Signatory::create([
            'report_header_id' => 11,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 11,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 11,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
        //MORTUARY
        Signatory::create([
            'report_header_id' => 4,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 4,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 4,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
        //MORTUARY DAILY CLAIMS
        Signatory::create([
            'report_header_id' => 12,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 12,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 12,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
        //CASH ADVANCE
        Signatory::create([
            'report_header_id' => 5,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 5,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 5,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
        //COMMUNITY RELATIONS
        Signatory::create([
            'report_header_id' => 6,
            'name' => 'FUNNY C. BALENDES',
            'position' => 'Member Benefits-in-charge',
            'description' => 'Prepaid by'
        ]);
        Signatory::create([
            'report_header_id' => 6,
            'name' => 'JOHN EFFIE T. BELARMA',
            'position' => 'Membership Supervisor',
            'description' => 'Checked by'
        ]);
        Signatory::create([
            'report_header_id' => 6,
            'name' => 'MYTHEL FAITH S. MANLANGIT',
            'position' => 'CAD Department Head',
            'description' => 'Conformed by'
        ]);
    }
}
