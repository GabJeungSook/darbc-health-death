<?php

namespace Database\Seeders;
use App\Models\Purpose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Purpose
        Purpose::create([
        'name' => 'Medical Assistance',
        ]);
        //Purpose
        Purpose::create([
        'name' => 'Community/Event Sponsorship',
        ]);
        //Purpose
        Purpose::create([
        'name' => 'School Assistance',
        ]);
        //Purpose
        Purpose::create([
        'name' => 'Church Assistance',
        ]);
        //Purpose
        Purpose::create([
        'name' => 'General Assembly',
        ]);
    }
}
