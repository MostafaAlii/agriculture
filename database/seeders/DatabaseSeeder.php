<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Image;
class DatabaseSeeder extends Seeder {
    public function run() {
        $count = 32;
        $this->call([
            FarmerTableSeeder::class,
            AdminTableSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
        ]);
        \App\Models\Admin::factory(30)->create();
        \App\Models\User::factory(30)->create();
        \App\Models\Farmer::factory(30)->create();
        // \App\Models\Image::factory(90)->create();
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
    }
}
