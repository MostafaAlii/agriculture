<?php
namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Area;
use App\Models\Country;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class AreaSeeder extends Seeder {
    public function run() {
        $count =5;
        $anbar_names = [
            "الرمادى",
            "الفلوجه",
            "القائم",
            "الحبانيه",
            "الجزيره",
        ];
        $dahok_names = [
            "زاخو",
            "داهوك",
            "العماديه",
            "sumail",
            "hezany",
        ];
        $bagdad_names = [
            "الكرخ",
            "المدائن",
            "الاعظميه",
            "الكاظميه",
            "المحموديه",
        ];
        DB::table('areas')->delete();

        for ($i = 0; $i < $count ; $i++) {
            Area::create([
                'name'          => $anbar_names[$i],
                'province_id'       => 1,
            ]);
        }
        for ($i = 0; $i < $count ; $i++) {
            Area::create([
                'name'          => $dahok_names[$i],
                'province_id'       => 2,
            ]);
        }
        for ($i = 0; $i < $count ; $i++) {
            Area::create([
                'name'          => $bagdad_names[$i],
                'province_id'       => 3,
            ]);
        }
        // Area::factory(5)->create();
    }
}
