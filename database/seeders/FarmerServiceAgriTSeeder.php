<?php
namespace Database\Seeders;

use App\Models\FarmerServiceAgriT;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FarmerServiceAgriTSeeder extends Seeder {
    public function run() {

        FarmerServiceAgriT::factory()->count(3)->create();
    }
}
