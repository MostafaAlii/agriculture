<?php
namespace Database\Seeders;

use App\Models\Country;
use App\Models\CountryTranslation;
use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    public function run() {
        $count = 32;
        \App\Models\Department::factory(6)->create();
        $this->call([
            CountrySeeder::class,
            ProvinceSeeder::class,
            AreaSeeder::class,
            StateSeeder::class,
            VillageSeeder::class,
            // VillageSeeder::class,
            FarmerTableSeeder::class,
            AdminTableSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
        ]);

        \App\Models\Admin::factory(30)->create();
        \App\Models\Farmer::factory(30)->create();
        \App\Models\User::factory(30)->create();
         // images
         for ($i = 1; $i <= $count ; $i++) {
            Image::insert([
                'filename'     => rand(1,10) . ".jpg",
                'imageable_id' => $i,
                'imageable_type' => 'App\Models\User'
            ]);
        }
           // image3
           for ($i = 1; $i <= $count ; $i++) {
            Image::insert([
                'filename'     => rand(1,10) . ".jpg",
                'imageable_id' => $i,
                'imageable_type' => 'App\Models\Farmer'
            ]);
        }

            // images
            for ($i = 1; $i <= $count ; $i++) {
                Image::insert([
                    'filename'     => rand(1,10) . ".jpg",
                    'imageable_id' => $i,
                    'imageable_type' => 'App\Models\Admin'
                ]);
            }

            //  country
            // $country_names = [
            //     "Eygpt",
            //     "Usa",
            //     "Germany",
            //     "Canada",
            //     "Iraq",

            // ];
            // for ($i = 1; $i <= 5 ; $i++) {
            //     Country::insert([
            //         'country_logo'     => $i . ".jpg",
            //         'name' => $country_names[$i],
            //     ]);
            // }

            // country --->province --->area -->state-->village
            // DB::table('contries')->truncate();
            // DB::table('provinces')->truncate();
            // DB::table('areas')->truncate();
            // DB::table('states')->truncate();
            // DB::table('villages')->truncate();



            // for ($i = 1; $i <  5 ; $i++) {
            //     DB::table('Country_translations')->insert(
            //         [
            //           'name' => $country_names[$i],
            //           'locale' => 'en',
            //           'country_id'=>$i,
            //         ]
            //     );
            // }
    }
}
