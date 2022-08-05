<?php
namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Area;
use App\Models\Country;
use App\Models\Province;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class StateSeeder extends Seeder {
    public function run() {
        DB::table('states')->delete();
        State::factory(5)->create();
    }
}
