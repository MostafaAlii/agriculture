<?php
namespace Database\Seeders;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BrandSeeder extends Seeder {
    public function run() {
        DB::table('brands')->delete();
        Brand::factory()->count(5)->create();
    }
}
