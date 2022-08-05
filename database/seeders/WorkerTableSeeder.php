<?php
namespace Database\Seeders;

use App\Models\Area;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Department;
use App\Models\Image;
use App\Models\Province;
use App\Models\State;
use App\Models\Village;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory;

class WorkerTableSeeder extends Seeder {
    public function run() {
        $count = 10;
        $faker = Factory::create();
        DB::table('workers')->delete();
        Worker::create([
            'Firstname'         =>  'worker',
            'lastname'          =>  'worker',
            'email'             =>  'worker@app.com',
            'password'          =>  bcrypt('123123'),
            'phone'             =>'01099999999',
            'desc'             => 'thank you for use morasoft',
            'address1'          =>  'cairo',
            'address2'          =>  'alex',
            'birthdate'         =>  Carbon::create('2000', '01', '01'),
            'country_id'        => 1,
            'province_id'       => 1,
            'area_id'           => 1,
            'state_id'          => 1,
            'village_id'        => 1,
            'currency_id'       => 1,
            'status'            =>true,
            'remember_token'    => Str::random(10),
        ]);
        for ($i = 1; $i <= $count; $i++) {
            $workers[] = [
                'firstname'        => $faker->name(),
                'lastname'         => $faker->name(),
                'email'            => $faker->unique()->safeEmail(),
                'phone'            => $faker->numerify('###########'),
                'desc'             => $faker->sentence(),
                'email_verified_at' => now(),
                'password'         => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'address1'         => $faker->streetAddress,
                'address2'         => $faker->streetAddress,
                'area_id'          => $faker->numberBetween(1, Area::count()),
                'province_id'      => $faker->numberBetween(1, Province::count()),
                'country_id'       => $faker->numberBetween(1, Country::count()),
                'state_id'         => $faker->numberBetween(1, State::count()),
                'village_id'       => $faker->numberBetween(1, Village::count()),
                'currency_id'      => $faker->numberBetween(1, Currency::count()),
                'status'           => rand(0,1),
                'salary'           => $faker->randomElement(['perhour', 'perday']),
                'work'             => $faker->randomElement(['alone', 'team']),
                'birthdate'        => $faker->date,
                'remember_token'   => Str::random(10),
                'created_at'       => Carbon::now(),
            ];
        }
        $chunks = array_chunk($workers, 100);
        foreach ($chunks as $chunk) {
            Worker::insert($chunk);
        }

        // images
        for ($i = 1; $i <= $count+1 ; $i++) {
            Image::insert([
                'filename'     => rand(1,6) . ".jpg",
                'imageable_id' => $i,
                'imageable_type' => 'App\Models\Worker'
            ]);
        }
    }
}
