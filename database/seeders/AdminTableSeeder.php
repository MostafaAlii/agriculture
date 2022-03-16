<?php
namespace Database\Seeders;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class AdminTableSeeder extends Seeder {
    public function run() {
        DB::table('admins')->delete();
        Admin::create([
            'firstname'         =>  'Mostafa',
            'lastname'          =>  'Ali',
            'email'             =>  'admin@app.com',
            'phone'             =>  '01015558628',
            'password'          =>  bcrypt('123123'),
            'address1'          =>  'cairo',
            'address2'          =>  'alex',
            'birthdate'         =>  Carbon::create('2000', '01', '01'),
            'remember_token'    => Str::random(10),
        ]);
        Admin::create([
            'firstname'         =>  'yyy',
            'lastname'          =>  'yyy',
            'email'             =>  'yyy@app.com',
            'phone'             =>  '01015588628',
            'password'          =>  bcrypt('123123'),
            'address1'          =>  'cairo',
            'address2'          =>  'alex',
            'birthdate'         =>  Carbon::create('2000', '01', '01'),
            'remember_token'    => Str::random(10),
        ]);

    }
}
