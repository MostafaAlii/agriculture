<?php
namespace Database\Seeders;
use App\Models\AgriTService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class AgriToolSeeder extends Seeder {
    public function run() {
        $count =4;
        $agriTtypes = [
            "تركتور",
            "مضخة",
            " حصادة",
            "أخرى",

        ];
        DB::table('agri_t_services')->delete();

        for ($i = 0; $i < $count ; $i++) {
        AgriTService::create([
            'name'          =>$agriTtypes[$i],

        ]);
        }


    }
}
