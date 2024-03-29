<?php

namespace Database\Factories;

use App\Models\Unit;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UnitFactory extends Factory
{
    protected $model = Unit::class;
    public function definition()
    {
        $units = [
            "كيلو جرام",
            "كرتونة",
            "دونم",
            "ملى",
            "سنتى",
            "ميلي متر",
            "سنتي متر",
        ];

            return [
                'Name'             => $this->faker->unique()->randomElement([$units[0],$units[1],$units[2],$units[3],$units[4],$units[5],$units[6]]),
                'visibility'       => $this->faker->randomElement([Unit::GENERAL,Unit::FOR_PRODUCT]),
            ];




    }


}
