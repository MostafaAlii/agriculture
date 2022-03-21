<?php

namespace Database\Factories;


use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class tagFactory extends Factory
{
    protected $model = Tag::class;
    public function definition()
    {
        return [
            'name'      => $this->faker->name(),
        ];



    }


}
