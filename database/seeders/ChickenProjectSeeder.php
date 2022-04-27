<?php
namespace Database\Seeders;

use App\Models\ChickenProject;
use App\Models\Precipitation;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ChickenProjectSeeder extends Seeder {
    public function run() {
        
      ChickenProject::factory()->count(30)->create();
    }
}
