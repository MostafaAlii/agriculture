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
            'name'          =>  'MostafaA',
            'email'         =>  'admin@app.com',
            'password'      =>  bcrypt('123123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
