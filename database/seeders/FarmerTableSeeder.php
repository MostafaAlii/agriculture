<?php
namespace Database\Seeders;
use App\Models\Farmer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class FarmerTableSeeder extends Seeder {
    public function run() {
        DB::table('users')->delete();
        $farmer = Farmer::create([
            'name'          =>  'MostafaF',
            'email'         =>  'farmer@app.com',
            'password'      =>  bcrypt('123123'),
            'remember_token' => Str::random(10),
        ]);
        Farmer::create([
            'name' => 'Ahmed',
            'email' => 'ahmed@gmail.com',
            'password' => bcrypt('258258258'),
            'remember_token' => Str::random(10),
        ]);
    }
}
