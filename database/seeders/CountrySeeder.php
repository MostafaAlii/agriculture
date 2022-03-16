<?php
namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class CountrySeeder extends Seeder {
    public function run() {
        DB::table('countries')->delete();
        Country::factory(5)->create();


    }
}
