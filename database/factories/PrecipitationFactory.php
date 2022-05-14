<?php

namespace Database\Factories;
use App\Models\Area;
use App\Models\Precipitation;
use App\Models\Village;
use App\Models\State;
use App\Models\Admin;
use App\Models\Unit;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PrecipitationFactory extends Factory
{
   protected $molel= Precipitation::class;
    public function definition()
    {
        return [

            'admin_id'       => $this->faker->numberBetween(1, Admin::count()),
            'area_id'       => $this->faker->numberBetween(1, Area::count()),
            'state_id'       => $this->faker->numberBetween(1, State::count()),
            'unit_id'      => $this->faker->randomElement([5, 6]),
            'precipitation_rate'=>$this->faker->numberBetween([1,2,3,4,5]),
            'date'    => $this->faker->date(),

        ];
    }



}
