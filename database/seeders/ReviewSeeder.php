<?php
namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReviewSeeder extends Seeder {
    
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('reviews')->truncate();
        Review::factory()->count(5)->create();
        Schema::enableForeignKeyConstraints();
    }
}
