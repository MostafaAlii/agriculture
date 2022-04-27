<?php
namespace Database\Seeders;

use App\Models\Orchard;
use App\Models\OutcomeProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OutcomeProductSeeder extends Seeder {
    public function run() {
        
      OutcomeProduct::factory()->count(30)->create();
    }
}
