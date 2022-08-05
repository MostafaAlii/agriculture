<?php
namespace Database\Seeders;

use App\Models\Orchard;
use App\Models\OrchardTree;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OrchardTreeSeeder extends Seeder {
    public function run() {
        
      OrchardTree::factory()->count(3)->create();
    }
}
