<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          //HEALTH
          Report::create([
            'name' => 'health',
        ]);
         //DEATH
         Report::create([
            'name' => 'death',
        ]);
         //LOG
         Report::create([
            'name' => 'log',
        ]);
         //MORTUARY
         Report::create([
            'name' => 'mortuary',
        ]);
         //CASH ADVANCE
         Report::create([
            'name' => 'cash advance',
        ]);
        //COMMUNITY RELATIONS
         Report::create([
            'name' => 'community relations',
        ]);
    }
}
