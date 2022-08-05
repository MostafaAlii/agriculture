<?php
namespace Database\Seeders;

use App\Models\FarmerServiceWater;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FarmerServiceWaterSeeder extends Seeder {
    public function run() {

        FarmerServiceWater::factory()->count(3)->create();
    }
}
