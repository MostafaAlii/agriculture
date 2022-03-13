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
            'filename' => $this->faker->name(),
            // 'imageable_id' => $this->faker->numberBetween(0,20),
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
