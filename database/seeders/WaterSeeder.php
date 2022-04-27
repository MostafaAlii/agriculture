<?php
namespace Database\Seeders;
use App\Models\AgriService;
use App\Models\WaterService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class WaterSeeder extends Seeder {
    public function run() {
        $count =5;
        $water_services_types = [
            "آبار ارتوازية",
            "آبار سطحية",
            "برك",
            "سد ترابي",
            "عيون",

        ];
        DB::table('water_services')->delete();

        for ($i = 0; $i < $count ; $i++) {
        WaterService::create([
            'name'          =>$water_services_types[$i],

        ]);
        }


    }
}
