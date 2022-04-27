<?php
namespace Database\Seeders;

use App\Models\BeeKeeperBeeDisaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BeeKeeperBeeDisasterSeeder extends Seeder {
    public function run() {
        
      BeeKeeperBeeDisaster::factory()->count(30)->create();
    }
}
