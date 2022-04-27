<?php

namespace Database\Factories;

use App\Models\Crop;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CropFactory extends Factory
{
    protected $model = Crop::class;
    public function definition()
    {
        $cropnames = [
            "محصول القمح و الشعير",
            "محصول الخضروات الشتوية",
            "محصول الخضروات الصيفية",
            "محصول البطاطا"
        ];
        $croptypes = [
            "summer",
            "winter",


        ];
            return [
                'name'             => $this->faker->randomElement([$cropnames[0],$cropnames[1],$cropnames[2],$cropnames[3]]),
                'crop_type'             => $this->faker->randomElement( ['summer','winter']),

            ];




    }


}
