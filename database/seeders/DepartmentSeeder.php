<?php
namespace Database\Seeders;

use App\Models\Area;
use App\Models\Admin;
use App\Models\State;
use App\Models\Country;
use App\Models\Village;
use App\Models\Province;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DepartmentSeeder extends Seeder {
    public function run() {
        
        $count =3;
        $department_names = [
            "اداره المنتجات الزراعيه",
            "اداره المنتجات الحيوانيه",
            "اداره الثروه السمكيه",
        ];
        $department_descriptions = [
            "وصف اداره المنتجات الزراعيه",
            "وصف اداره المنتجات الحيوانيه",
            "وصف اداره الثروه السمكيه",
        ];
        $department_keywords = [
            "كلمات اداره المنتجات الزراعيه",
            "كلمات اداره المنتجات الحيوانيه",
            "كلمات اداره الثروه السمكيه",
        ];
        
        //DB::table('departments')->delete();
        Schema::disableForeignKeyConstraints();

        DB::table('departments')->truncate();
        DB::table('department_translations')->truncate();

        for ($i = 0; $i < $count ; $i++) {
            Department::create([
                'name'          => $department_names[$i],
                'slug'          => str_replace(' ', '_',$department_names[$i]),
                'description'   => $department_descriptions[$i],
                'keyword'       => $department_keywords[$i],
                'country_id'    => Country::all()->random()->id,
                'province_id'   => Province::all()->random()->id,
                'area_id'       => Area::all()->random()->id,
                'state_id'      => State::all()->random()->id,
                'village_id'    => Village::all()->random()->id,
              //  'created_by'    => Admin::all()->random()->id,
                ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
