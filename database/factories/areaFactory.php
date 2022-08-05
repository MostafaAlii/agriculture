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

class areaFactory extends Factory
{
    protected $model = Area::class;
    public function definition()
    {
         //  province
            return [
                'name'             => $this->faker->randomElement(['z','qqq','www','eee','fff','ggg','lll','ooo']),
                'province_id'       => $this->faker->numberBetween(1, Province::count()),

            ];



    }


}
