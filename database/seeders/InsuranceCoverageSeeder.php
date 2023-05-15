<?php

namespace Database\Seeders;
use App\Models\InsuranceCoverage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsuranceCoverageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //MEMBER
         InsuranceCoverage::create([
            'amount' => 1000,
            'number_of_days' => 30,
            'category' => 'MEMBER',
        ]);

           //DEPENDENT
           InsuranceCoverage::create([
            'amount' => 300,
            'number_of_days' => 15,
            'category' => 'DEPENDENT',
        ]);
    }
}
