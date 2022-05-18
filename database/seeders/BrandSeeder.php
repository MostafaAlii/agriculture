<?php
namespace Database\Seeders;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class BrandSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('brands')->truncate();
        Brand::factory()->count(5)->create();
        Schema::enableForeignKeyConstraints();
    }
}
