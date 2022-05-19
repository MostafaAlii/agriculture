<?php
namespace Database\Seeders;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class AdminTableSeeder extends Seeder {
    public function run() {
        DB::table('admins')->delete();
        $superAdmin = Admin::create([
                        'firstname'                     =>              'Mostafa',
                        'lastname'                      =>              'Ali',
                        'email'                         =>              'admin@app.com',
                        'phone'                         =>              '01015558628',
                        'password'                      =>              bcrypt('123123'),
                        'address1'                      =>              'cairo',
                        'address2'                      =>              'alex',
                        'birthdate'                     =>              Carbon::create('2000', '01', '01'),
                        'country_id'                    =>              1,
                        'province_id'                   =>              1,
                        'area_id'                       =>              1,
                        'state_id'                      =>              1,
                        'village_id'                    =>              1,
                        'department_id'                 =>              1,
                        'admin_department_id'           =>              4,
                        'roles_name'                    =>              ["Owner"],
                        'status'                        =>              Admin::ACTIVE,
                        'remember_token'                =>              Str::random(10),
                    ]);
        $role = Role::create(['name' => 'Owner']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $superAdmin->assignRole([$role->id]);
    }
}