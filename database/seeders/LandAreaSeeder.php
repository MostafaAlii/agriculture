<?php
namespace Database\Seeders;

use App\Models\LandArea;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LandAreaSeeder extends Seeder {
    public function run() {
        
      LandArea::factory()->count(3)->create();
    }
}
