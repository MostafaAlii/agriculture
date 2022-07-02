<?php
namespace Database\Seeders;

use App\Models\SummerCropFarmerCrop;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SummerCropFarmerCropSeeder extends Seeder {
    public function run() {
        
      SummerCropFarmerCrop::factory()->count(3)->create();
    }
}
