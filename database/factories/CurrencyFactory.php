<?php

namespace Database\Factories;

use App\Models\Currency;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CurrencyFactory extends Factory
{

    protected $model = Currency::class;
    public function definition()
    {
        $currencies = [
            "دولار",
            "دينار عراقي",
            "يورو",

        ];

        return [
            'Name'             => $this->faker->unique()->randomElement([$currencies[0],$currencies[1],$currencies[2]])

        ];




    }


}
