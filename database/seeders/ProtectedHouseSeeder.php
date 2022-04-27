<?php
namespace Database\Seeders;

use App\Models\ProtectedHouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProtectedHouseSeeder extends Seeder {
    public function run() {

        ProtectedHouse::factory()->count(30)->create();
    }
}
