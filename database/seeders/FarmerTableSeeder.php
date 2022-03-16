<?php
namespace Database\Seeders;
use App\Models\Farmer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class FarmerTableSeeder extends Seeder {
    public function run() {
        DB::table('users')->delete();
        Farmer::create([
            'Firstname'       =>  'MostafaF',
            'lastname'        => 'Ali',
            'email'           =>  'farmer@app.com',
            'password'        =>  bcrypt('123123'),
            'phone'           =>'01021555555',
            'address1'          =>  'cairo',
            'address2'          =>  'alex',
            'birthdate'         =>  Carbon::create('2000', '01', '01'),
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
            'remember_token' => Str::random(10),
        ]);
    }
}
