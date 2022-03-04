<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'name' => 'ahmed ragab',
            'email' => 'ahmedragabyasin2020@gmail.com',
            'password' => Hash::make('258258258'),
            // 'type' => 'Admin',
        ]);
        User::create([
            'name' => 'wolf',
            'email' => 'wolf@gmail.com',
            'password' => Hash::make('258258258'),
            // 'type' => 'Farmer',
        ]);
    }
}
