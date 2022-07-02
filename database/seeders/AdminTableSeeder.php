<?php
namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class AdminTableSeeder extends Seeder {
    public function run() {
        
        Schema::disableForeignKeyConstraints();
        DB::table('admins')->truncate();
      //  DB::table('admins')->delete();
        $superAdmin = Admin::create([
                        'firstname'                     =>              'Mostafa',
                        'lastname'                      =>              'Ali',
                        'email'                         =>              'admin@app.com',
                        'phone'                         =>              '0100000000',
                        'password'                      =>              bcrypt('123123'),
                        'roles_name'                    =>              ["Owner"],
                        'status'                        =>              Admin::ACTIVE,
                        'remember_token'                =>              Str::random(10),
                    ]);
        $role = Role::create(['name' => 'Owner']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $superAdmin->assignRole([$role->id]);

//        Admin::create([
//            'firstname'         =>  'yyy',
//            'lastname'          =>  'yyy',
//            'email'             =>  'ahmedragabyasin2020@gmail.com',
//            'phone'             =>  '01015588628',
//            'password'          =>  bcrypt('123123'),
//            'address1'          =>  'cairo',
//            'address2'          =>  'alex',
//            'birthdate'         =>  Carbon::create('2000', '01', '01'),
//            'country_id'        => 2,
//            'province_id'       => 2,
//            'area_id'           => 2,
//            'state_id'          => 2,
//            'village_id'        => 2,
//            'department_id'     => 2,
//            'admin_department_id'           =>              4,
//            'roles_name'                    =>              ["Owner"],
//            'status'                        =>              Admin::ACTIVE,
//            'remember_token'    => Str::random(10),
//        ]);
        Admin::factory(2)->create();
        Schema::enableForeignKeyConstraints();
    }
}
