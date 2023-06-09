<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReportSignatory;

class ReportSignatorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          //LOG
          ReportSignatory::create([
            'report_id' => 3,
            'name' => 'VINCENT E. PALMA',
            'position' => 'Chairman of the Board',
        ]);
    }
}
