<?php
namespace Database\Seeders;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use App\Traits\TableAutoIncreamentTrait;
class TeamSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('teams')->truncate();
        Team::factory()->count(35)->create();
        Schema::enableForeignKeyConstraints();
        //create cache file
        Cache::store('file')->add('teams',Team::get());
    }
}
