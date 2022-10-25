<?php
namespace Database\Seeders;
use App\Models\{Brand, Image};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Schema};

class BrandSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('brands')->truncate();
        Brand::factory()->count(5)->create();
        Schema::enableForeignKeyConstraints();
    }
}