<?php
namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Traits\TableAutoIncreamentTrait;
class ReviewSeeder extends Seeder {
    use TableAutoIncreamentTrait;
    
    public function run() {
        DB::table('reviews')->delete();
        //call trait to handel aut-increament
        $this->refreshTable('reviews');
        Review::factory(9)->create();
    }
}
