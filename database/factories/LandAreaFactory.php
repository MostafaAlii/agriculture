<?php

namespace Database\Factories;
use App\Models\LandArea;
use App\Models\LandCategory;
use App\Models\Area;
use App\Models\Village;
use App\Models\State;
use App\Models\Admin;
use App\Models\Unit;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LandAreaFactory extends Factory
{
   protected $molel= LandArea::class;
    public function definition()
    {
        return [


            'village_id'    => $this->faker->numberBetween(1, Village::count()),
            'area_id'    => $this->faker->numberBetween(1, Area::count()),
            'state_id'    => $this->faker->numberBetween(1, State::count()),
            'admin_id'       => $this->faker->numberBetween(1, Admin::count()),
            'unit_id'      => $this->faker->randomElement([3, 4]),
            'L_area'=>$this->faker->numberBetween([1,2,3,4, 5]),
            'land_category_id'    => $this->faker->numberBetween(1, LandCategory::count()),

        ];
    }



}
