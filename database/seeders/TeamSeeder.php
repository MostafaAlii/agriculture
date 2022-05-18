<?php
namespace Database\Seeders;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Traits\TableAutoIncreamentTrait;

class TeamSeeder extends Seeder {
    use TableAutoIncreamentTrait;
    
    public function run() {
        DB::table('teams')->delete();
        //call trait to handel aut-increament
        $this->refreshTable('teams');
       
        Team::factory(9)->create();

        //create cache file
        Cache::store('file')->add('teams',Team::get());
    }
}
