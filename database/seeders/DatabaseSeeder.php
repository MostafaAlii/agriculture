<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        $this->call([
            FarmerTableSeeder::class,
            AdminTableSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
        ]);
        \App\Models\User::factory(30)->create();
        \App\Models\Farmer::factory(30)->create();
    }
}
