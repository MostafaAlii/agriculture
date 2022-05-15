<?php
namespace Database\Seeders;
use App\Models\LandCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class LandCategorySeeder extends Seeder {
    public function run() {
        $count =5;
        $category_name_1 = [
            "أراضي سيحية",
            "أراضي ديمية",
            "قمريات",
            "بساتين سيحية",
            "بساتين ديمية"
        ];
        $category_name_2 = [
            "غابات طبيعية",
            "أراضي بلدية",
            "مباني حكومية",
            "أراضي صخرية و مرعى",
            "منافع عامة"

        ];


        DB::table('land_categories')->delete();

        for ($i = 0; $i < $count ; $i++) {
            LandCategory::create([
                'category_name'          => $category_name_1[$i],
                'category_type'    => 'زراعي',
            ]);
        }
        for ($i = 0; $i < $count ; $i++) {
            LandCategory::create([
                'category_name'          => $category_name_2[$i],
                'category_type'    => 'غير زراعي',
            ]);
        }

    }
}
