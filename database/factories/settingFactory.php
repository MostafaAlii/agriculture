<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class settingFactory extends Factory
{
    protected $model = Setting::class;
    public function definition()
    {
        return [
            'site_name' => $this->faker->name,
        ];
    }
}

