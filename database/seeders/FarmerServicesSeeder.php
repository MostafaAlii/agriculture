<?php
namespace Database\Seeders;

use App\Models\FarmerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FarmerServicesSeeder extends Seeder {
    public function run() {

        FarmerService::factory()->count(30)->create();
    }
}
