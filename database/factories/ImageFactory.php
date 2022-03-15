<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Farmer;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
    protected $model = Image::class;
    public function definition()
    {
        $imageable = $this->imageable();
        return [
            'filename' => $this->faker->randomElement(['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','avatar.jpg']),
            'imageable_id' => $imageable::factory(),
            'imageable_type' => $imageable,

        ];
    }


    public function imageable()
    {
        return $this->faker->randomElement([
            Admin::class,
            User::class,
            Farmer::class,
        ]);
    }
}
