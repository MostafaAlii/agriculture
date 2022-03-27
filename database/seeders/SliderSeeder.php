<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{

    public function run()
    {
        DB::table('sliders')->delete();
        Slider::factory(3)->create();
    }
}
