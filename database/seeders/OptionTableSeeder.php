<?php
namespace Database\Seeders;
use App\Models\Option;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class OptionTableSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('options')->truncate();
        Option::factory()->count(35)->create();
        Schema::enableForeignKeyConstraints();
    }
}
