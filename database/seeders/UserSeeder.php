<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'firstname' => 'ahmed',
            'lastname' => 'ragab',
            'email' => 'ahmedragabyasin2020@gmail.com',
            'password' => bcrypt('258258258'),
            'phone'=>'00201021493036',
            'address'=>'egypt',
            'remember_token' => Str::random(10),
        ]);
        // User::create([
        //     'name' => 'wolf',
        //     'email' => 'wolf@gmail.com',
        //     'password' => Hash::make('258258258'),
        //     'remember_token' => Str::random(10),
        // ]);
    }
}
