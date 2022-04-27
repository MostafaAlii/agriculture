<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Country;
use App\Models\Department;
use App\Models\Province;
use App\Models\State;
use App\Models\Village;
use App\Models\WholeProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WholeProductFactory extends Factory
{
    protected $model = WholeProduct::class;
    public function definition()
    {
            $product = [
                "طماطم",
                "خيار",
                "بطاطا",
                "بطيخ",
                "ملوخية",
                "فاصولياء",
                "تين","بصل","ثوم","تفاح"

            ];
            return [
                'name'             => $this->faker->randomElement([$product[0],$product[1],$product[2],$product[3],$product[4],
                    $product[5],$product[6],$product[7],$product[8],$product[9]  ]),

            ];




    }


}
