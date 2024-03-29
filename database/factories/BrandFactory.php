<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;
    public function definition()
    {
        return [
            'title'    =>$this->faker->sentence(5),
        ];
    }
}
