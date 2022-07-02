<?php
namespace Database\Seeders;

use App\Models\FarmerCrop;
use App\Models\Orchard;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FarmerCropSeeder extends Seeder {
    public function run() {
        
      FarmerCrop::factory()->count(3)->create();
    }
}
