<?php
namespace Database\Seeders;

use App\Models\CropFarmerCrop;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CropFarmerCropSeeder extends Seeder {
    public function run() {
        
      CropFarmerCrop::factory()->count(30)->create();
    }
}
