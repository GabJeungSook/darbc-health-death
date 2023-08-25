<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class NewUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Funny',
            'username' => 'DARBCMEMBERSHIP',
            'email' => 'adminfunny@darbc.com',
            'password' => Hash::make('funny'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'Community Relations',
            'username' => 'DARBCMEMBERSHIPCOMMUNITY',
            'email' => 'communityadmin@darbc.com',
            'password' => Hash::make('community'),
            'role_id' => 2,
        ]);
    }
}
