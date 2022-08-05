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
            // 'site_name' => $this->faker->name,
            // 'address' => $this->faker->name,
            // 'message_maintenance' => $this->faker->name,
            // 'support_mail' => $this->faker->name,
            // 'facebook' => $this->faker->name,
            // 'inestegram' => $this->faker->name,
            // 'twitter' => $this->faker->name,
            // 'primary_phone' => $this->faker->name,
            // 'secondery_phone' => $this->faker->name,
            // 'status' => $this->faker->name,
            // 'site_logo' => $this->faker->name,
            // 'site_icon' => $this->faker->name,
        ];
    }
}

