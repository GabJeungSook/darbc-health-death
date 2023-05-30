<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SupervisorCodeSeeder::class,
            InsuranceCoverageSeeder::class,
            ReportSeeder::class,
            ReportHeaderSeeder::class,
            ReportSignatorySeeder::class,
            PurposeSeeder::class,
            TypeSeeder::class,
        ]);
    }
}
