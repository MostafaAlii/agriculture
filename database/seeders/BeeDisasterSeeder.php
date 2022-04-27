<?php
namespace Database\Seeders;
use App\Models\BeeDisaster;
use App\Models\CourseBee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class BeeDisasterSeeder extends Seeder {
    public function run() {
        $count =4;
        $disasterBees_name = [
            "حرارة ",
            "برودة ",
            "حشرات فتاكة",
            "أخرى",

        ];
        $disasterBees_desc = [
            "وصف 1",
            "وصف 2 ",
            "وصف 3",
            "وصف 4",

        ];
        DB::table('bee_disasters')->delete();

        for ($i = 0; $i < $count ; $i++) {
        BeeDisaster::create([
            'name'          =>$disasterBees_name[$i],
            'desc'          =>$disasterBees_desc[$i],

        ]);
        }


    }
}
