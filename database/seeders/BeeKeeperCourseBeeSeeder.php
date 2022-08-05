<?php
namespace Database\Seeders;

use App\Models\BeeKeeperCourseBee;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BeeKeeperCourseBeeSeeder extends Seeder {
    public function run() {
        
      BeeKeeperCourseBee::factory()->count(30)->create();
    }
}
