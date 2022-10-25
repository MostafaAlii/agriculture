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
        /*for($i=1; $i <= Brand::count();$i++) {
            Image::create([
                'filename'     => rand(1,5) . ".jpg",
                'imageable_id' => $i,
                'imageable_type' => 'App\Models\Brand',
            ]);
        }*/
    }
}