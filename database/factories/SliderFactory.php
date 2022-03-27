<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    protected $model = Slider::class;
    public function definition()
    {
        return [
            'title'    =>$this->faker->text(50),
            'subtitle' =>$this->faker->text(100),
            // 'price' =>$this->faker->numberBetween(200,500),
        ];
    }
}
