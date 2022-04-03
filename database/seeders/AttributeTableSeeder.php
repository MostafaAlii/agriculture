<?php
namespace Database\Seeders;
use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class AttributeTableSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('attributes')->truncate();
        Attribute::factory()->count(35)->create();
        Schema::enableForeignKeyConstraints();
    }
}
