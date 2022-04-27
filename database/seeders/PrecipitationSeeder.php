<?php
namespace Database\Seeders;

use App\Models\Precipitation;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PrecipitationSeeder extends Seeder {
    public function run() {
        
      Precipitation::factory()->count(30)->create();
    }
}
