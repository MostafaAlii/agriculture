<?php
namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Department;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class DepartmentSeeder extends Seeder {
    public function run() {
        $count =3;
        $department_names = [
            "القسم الحيوانى",
            "القسم الزراعى",
            "قسم الالبان",
        ];
        DB::table('departments')->delete();

        for ($i = 0; $i < $count ; $i++) {
            Department::create([
                'name'          => $department_names[$i],
            ]);
        }
    }
}
