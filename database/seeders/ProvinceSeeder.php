<?php
namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class ProvinceSeeder extends Seeder {
    public function run() {
        $count =5;
        $province_iraq = [
            "الانبار",
            "دهوك",
            "بغداد",
            "البصره",
            "كركوك",
        ];
        $province_egypt = [
            "القاهره",
            "اسكندريه",
            "شرم الشيخ",
            "اسوان",
            "اسيوط",
        ];
        DB::table('provinces')->delete();

        for ($i = 0; $i < $count ; $i++) {
            Province::create([
                'name'          => $province_iraq[$i],
                'country_id'    => 1,
            ]);
        }
        for ($i = 0; $i < $count ; $i++) {
            Province::create([
                'name'          => $province_egypt[$i],
                'country_id'    => 2,
            ]);
        }
    // Province::factory(5)->create();
    }
}
