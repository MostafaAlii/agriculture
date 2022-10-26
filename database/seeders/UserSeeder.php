<?php
namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\{User, Image};
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'admin_department_id'=>4,
            'remember_token' => Str::random(10),
        ]);
        User::factory()->count(5)->create();
    }
}