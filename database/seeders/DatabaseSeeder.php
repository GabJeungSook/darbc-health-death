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
            NewUserSeeder::class,
            SupervisorCodeSeeder::class,
            InsuranceCoverageSeeder::class,
            ReportSeeder::class,
            ReportHeaderSeeder::class,
            ReportSignatorySeeder::class,
            PurposeSeeder::class,
            TypeSeeder::class,
            AdditionalSeeder::class,
            SignatorySeeder::class,
            RoleSeeder::class,
            NewAdminSeeder::class,
            AdditionalHealthSeeder::class,
            AdditionalReportHeaderSeeder::class,
        ]);
    }
}
