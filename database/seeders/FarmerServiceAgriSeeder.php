<?php
namespace Database\Seeders;

use App\Models\FarmerServiceAgri;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FarmerServiceAgriSeeder extends Seeder {
    public function run() {

        FarmerServiceAgri::factory()->count(30)->create();
    }
}
