<?php
namespace Database\Seeders;
use App\Models\TreeType;
use App\Models\Tree;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class TreeSeeder extends Seeder {
    public function run() {
        $count =4;
        $hamdiat = [
            "ليمون",
            "برتقال",
            "ليمون",
            "بوملي",
        ];
        $hiraji = [
            "بلوط",
            "الكستنا",
            "الصنوبر",
            "الأرز",

        ];
        $loziat = [
            "مشمش",
            "دراق",
            "لوز",
            "خوخ"

        ];
        $estewae=[
            "أفوكادو",
            "قشطة",
            "شوكولا",
            "مانغا"

        ];

        DB::table('trees')->delete();

        for ($i = 0; $i < $count ; $i++) {
            Tree::create([
                'name'          => $hamdiat[$i],
                'tree_type_id'    => 1,
            ]);
        }
        for ($i = 0; $i < $count ; $i++) {
            Tree::create([
                'name'          => $hiraji[$i],
                'tree_type_id'    => 2,
            ]);
        }
        for ($i = 0; $i < $count ; $i++) {
            Tree::create([
                'name'          => $loziat[$i],
                'tree_type_id'    => 3,
            ]);
        }
        for ($i = 0; $i < $count ; $i++) {
            Tree::create([
                'name'          => $estewae[$i],
                'tree_type_id'    => 4,
            ]);
        }
    // Province::factory(5)->create();
    }
}
