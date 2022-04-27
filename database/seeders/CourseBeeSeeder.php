<?php
namespace Database\Seeders;
use App\Models\CourseBee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class CourseBeeSeeder extends Seeder {
    public function run() {
        $count =4;
        $courseBees_name = [
            "كورس تعقيم الخلايا",
            "كورس  إطعام الخلايا ",
            "كورس نقل الخلايا",
            "كورس بناء خلايا صناعية",

        ];
        $courseBees_desc = [
            "وصف 1",
            "وصف 2 ",
            "وصف 3",
            "وصف 4",

        ];
        DB::table('course_bees')->delete();

        for ($i = 0; $i < $count ; $i++) {
        CourseBee::create([
            'name'          =>$courseBees_name[$i],
            'desc'          =>$courseBees_desc[$i],

        ]);
        }


    }
}
