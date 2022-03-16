<?php
namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Seeder;
class SettingSeeder extends Seeder {
    public function run() {
        Setting::factory()->count(1)->create();
    }
}
