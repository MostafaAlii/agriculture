<?php
namespace Database\Seeders;

use App\Models\WholeProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class WholeProductSeeder extends Seeder {
    public function run() {
        
      WholeProduct::factory()->count(3)->create();
    }
}
