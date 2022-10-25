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
    }
}