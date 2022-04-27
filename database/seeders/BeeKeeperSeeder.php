<?php
namespace Database\Seeders;

use App\Models\BeeKeeper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BeeKeeperSeeder extends Seeder {
    public function run() {
        
      BeeKeeper::factory()->count(30)->create();
    }
}
