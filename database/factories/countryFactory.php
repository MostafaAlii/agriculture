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

class countryFactory extends Factory
{
    protected $model = Country::class;
    public function definition()
    {
         //  country
            $i=1;
            $country = [
                "Eygpt",
                "Usa",
                "Germany",
                "Canada",
                "Iraq",

            ];
            return [
                'name'             => $this->faker->randomElement([$country[0],$country[1],$country[2],$country[3],$country[4]]),
                'country_logo'     => $this->faker->randomElement(['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg']),

            ];

            //    for ($i = 1; $i <= 5 ; $i++) {
                // return [
                //     'country_logo'     => $i++ . ".jpg",
                //     'name' => $country_names[$i++],
                // ];
            // }


    }


}
