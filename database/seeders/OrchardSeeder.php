<?php
namespace Database\Seeders;

use App\Models\Orchard;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OrchardSeeder extends Seeder {
    public function run() {
        
      Orchard::factory()->count(3)->create();
    }
}
