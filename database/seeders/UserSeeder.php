<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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
            'phone'=>'01021493036',
            'address1'          =>  'cairo',
            'address2'          =>  'alex',
            'birthdate'         =>  Carbon::create('2000', '01', '01'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'firstname' => 'xxx',
            'lastname' => 'xxx',
            'email' => 'xxx@gmail.com',
            'password' => bcrypt('258258258'),
            'phone'=>'01021493037',
            'address1'          =>  'cairo',
            'address2'          =>  'alex',
            'birthdate'         =>  Carbon::create('2000', '01', '01'),
            'remember_token' => Str::random(10),
        ]);
    }
}
