<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class blogFactory extends Factory
{
    protected $model = Blog::class;
    public function definition()
    {
        return [
            'title'     => $this->faker->name(),
            'body'      => $this->faker->text(),
            'admin_id'  => $this->faker->numberBetween(1, Admin::count()),

        ];
    }

}
