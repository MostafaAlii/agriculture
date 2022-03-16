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
        DB::table('provinces')->delete();
        Province::factory(5)->create();


    }
}
