<?php
namespace Database\Seeders;

use App\Models\IncomeProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class IncomeProductSeeder extends Seeder {
    public function run() {
        
      IncomeProduct::factory()->count(3)->create();
    }
}
