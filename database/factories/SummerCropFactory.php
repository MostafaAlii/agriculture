<?php

namespace Database\Factories;

use App\Models\SummerCrop;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SummerCropFactory extends Factory
{
    protected $model = SummerCrop::class;
    public function definition()
    {
        $cropnames = [
            "محصول القمح و الشعير",
            "محصول القطن ",
            "محصول البطاطا"
        ];
            return [
                'name'             => $this->faker->randomElement([$cropnames[0],$cropnames[1],$cropnames[2]]),

            ];




    }


}
