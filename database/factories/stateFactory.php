<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Country;
use App\Models\Department;
use App\Models\Province;
use App\Models\State;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class stateFactory extends Factory
{
    protected $model = State::class;
    public function definition()
    {
         //  province
            return [
                'name'             => $this->faker->state,
                'area_id'          => $this->faker->numberBetween(1, Area::count()),

            ];



    }


}
