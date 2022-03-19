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
        $count =5;
        $country_names = [
            "العراق",
            "مصر",
            "السعوديه",
            "سوريا",
            "فلسطين",
        ];
        DB::table('countries')->delete();

        for ($i = 0; $i < $count ; $i++) {
        Country::create([
            'country_logo'  =>'default_flag.jpg',
            'name'          =>$country_names[$i],

        ]);
        }
        // Country::factory(5)->create();


    }
}
