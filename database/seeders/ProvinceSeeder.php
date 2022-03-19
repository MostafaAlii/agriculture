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
        $province_names = [
            "الانبار",
            "دهوك",
            "بغداد",
            "البصره",
            "كركوك",
        ];
        DB::table('provinces')->delete();

        for ($i = 0; $i < $count ; $i++) {
            Province::create([
                'name'          => $province_names[$i],
                'country_id'    => 1,
            ]);
        }
    // Province::factory(5)->create();
    }
}
