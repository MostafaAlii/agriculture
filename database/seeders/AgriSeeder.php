<?php
namespace Database\Seeders;
use App\Models\AgriService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class AgriSeeder extends Seeder {
    public function run() {
        $count =6;
        $agritypes = [
            "عيادة بيطرية",
            "مكان تعقيم الحيوانات",
            "مخازن مبردة",
            "مفقس",
            "مكاتب بيع الأدوات الزراعية",
            "مكاتب بيع الدواجن الحية"
        ];
        DB::table('agri_services')->delete();

        for ($i = 0; $i < $count ; $i++) {
        AgriService::create([
            'name'          =>$agritypes[$i],

        ]);
        }


    }
}
