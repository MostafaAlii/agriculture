<?php
namespace Database\Seeders;
use App\Models\Admin;
use App\Models\TreeType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class TreeTypeSeeder extends Seeder {
    public function run() {
        $count =4;
        $type = [
            "حمضيات",
            "حراجية",
            "لوزيات",
            "استوائية",
        ];
        DB::table('tree_types')->delete();

        for ($i = 0; $i < $count ; $i++) {
        TreeType::create([
            'tree_type'          =>$type[$i],

        ]);
        }


    }
}
