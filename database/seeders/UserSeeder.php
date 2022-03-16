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
            'country_id'        => 1,
            'province_id'       => 1,
            'area_id'           => 1,
            'state_id'          => 1,
            'village_id'        => 1,
            'department_id'     => 1,
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
            'country_id'        => 2,
            'province_id'       => 2,
            'area_id'           => 2,
            'state_id'          => 2,
            'village_id'        => 2,
            'department_id'     => 2,
            'remember_token' => Str::random(10),
        ]);
    }
}
