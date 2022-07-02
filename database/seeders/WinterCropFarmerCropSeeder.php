<?php
namespace Database\Seeders;

use App\Models\WinterCropFarmerCrop;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class WinterCropFarmerCropSeeder extends Seeder {
    public function run() {
        
      WinterCropFarmerCrop::factory()->count(3)->create();
    }
}
