<?php
namespace Database\Seeders;

use App\Models\CawProject;
use App\Models\Orchard;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CawProjectSeeder extends Seeder {
    public function run() {
        
      CawProject::factory()->count(30)->create();
    }
}
