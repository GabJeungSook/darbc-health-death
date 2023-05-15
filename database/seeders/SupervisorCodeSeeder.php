<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupervisorCode;

class SupervisorCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            //CODE
            SupervisorCode::create([
                'code' => 12345,
            ]);

    }
}
