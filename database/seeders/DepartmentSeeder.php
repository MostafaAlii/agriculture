<?php
namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Department;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
class DepartmentSeeder extends Seeder {
    public function run() {
        
        $count =3;
        $department_names = [
            "القسم الحيوانى",
            "القسم الزراعى",
            "قسم الالبان",
        ];
        $department_descriptions = [
            "وصف القسم الحيوانى",
            "وصف القسم الزراعى",
            "وصف قسم الالبان",
        ];
        $department_keywords = [
            "كلمات القسم الحيوانى",
            "كلمات القسم الزراعى",
            "كلمات قسم الالبان",
        ];
        
        DB::table('departments')->delete();

        for ($i = 0; $i < $count ; $i++) {
            Department::create([
                'name'          => $department_names[$i],
                'slug'          => str_replace(' ', '_',$department_names[$i]),
                'description'   => $department_descriptions[$i],
                'keyword'       => $department_keywords[$i],
                'country_id'    => Country::all()->random()->id,
                'state_id'      => State::all()->random()->id,
            ]);
        }
    }
}
