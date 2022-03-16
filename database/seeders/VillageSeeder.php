<?php
namespace Database\Seeders;

use App\Models\Village;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class VillageSeeder extends Seeder {
    public function run() {
        DB::table('villages')->delete();
        Village::factory(5)->create();
    }
}
