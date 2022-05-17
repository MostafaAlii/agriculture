<?php

namespace Database\Factories;

use App\Models\WinterCrop;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WinterCropFactory extends Factory
{
    protected $model = WinterCrop::class;
    public function definition()
    {
        $cropnames = [
            "محصول الخضروات الشتوية",
            "محصول الخضروات العدس",
            "محصول اليانسون"
        ];
            return [
                'name'             => $this->faker->randomElement([$cropnames[0],$cropnames[1],$cropnames[2]]),

            ];




    }


}
