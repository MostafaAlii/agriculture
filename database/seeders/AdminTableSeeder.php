<?php
namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class AdminTableSeeder extends Seeder {
    public function run() {
        DB::table('admins')->delete();
        $admin = Admin::create([
            'firstname'         =>  'Mostafa',
            'lastname'          =>  'Ali',
            'email'             =>  'admin@app.com',
            'phone'             =>  '01015558628',
            'password'          =>  bcrypt('123123'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
