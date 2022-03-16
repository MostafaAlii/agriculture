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
        DB::table('areas')->delete();
        Area::factory(5)->create();
    }
}
