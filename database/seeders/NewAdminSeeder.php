<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class NewAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jhon Effie',
            'username' => 'DARBCMEMBERSHIPADMIN',
            'email' => 'adminjohn@darbc.com',
            'password' => Hash::make('darbcadmin'),
            'role_id' => 1,
        ]);
    }
}
