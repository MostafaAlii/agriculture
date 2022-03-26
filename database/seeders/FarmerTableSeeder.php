<?php
namespace Database\Seeders;
use App\Models\Farmer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class FarmerTableSeeder extends Seeder {
    public function run() {
        DB::table('farmers')->delete();
        Farmer::create([
            'Firstname'       =>  'MostafaF',
            'lastname'        => 'Ali',
            'email'           =>  'farmer@app.com',
            'password'        =>  bcrypt('123123'),
            'phone'           =>'01021555555',
            'address1'          =>  'cairo',
            'address2'          =>  'alex',
            'birthdate'         =>  Carbon::create('2000', '01', '01'),
            'country_id'        => 1,
            'province_id'       => 1,
            'area_id'           => 1,
            'state_id'          => 1,
            'village_id'        => 1,
            'department_id'     => 1,
            'remember_token'  => Str::random(10),
        ]);
        Farmer::create([
            'firstname'      => 'zzz',
            'lastname'       => 'zzz',
            'email'          => 'zzz@gmail.com',
            'password'       => bcrypt('258258258'),
            'phone'          =>'11021493036',
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
