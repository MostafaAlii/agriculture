<?php
namespace Database\Seeders;
use App\Models\{Slider, Image};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Schema};
class SliderSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('sliders')->truncate();
        Slider::factory()->count(3)->create();
        Schema::enableForeignKeyConstraints();
        for($i=1; $i <= Slider::count();$i++) {
            Image::create([
                'filename'     => rand(1,3) . ".jpg",
                'imageable_id' => $i,
                'imageable_type' => 'App\Models\Slider',
            ]);
        }
    }
}