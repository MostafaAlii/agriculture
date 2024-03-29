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

class provinceFactory extends Factory
{
    protected $model = Province::class;
    public function definition()
    {
         //  province
            return [
                'name'             => $this->faker->randomElement(['xxx','qqq','www','eee','fff','ggg','lll','ooo']),
                'country_id'       => $this->faker->numberBetween(1, Country::count()),

            ];



    }


}
