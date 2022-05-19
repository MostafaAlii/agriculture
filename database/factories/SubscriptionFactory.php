<?php
namespace Database\Factories;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
class SubscriptionFactory extends Factory {
    public function definition() {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'subscription_end_date' =>
            Carbon::createFromTimeStamp($this->faker->dateTimeBetween('+10 days', '+30 days')->getTimestamp()),
        ];
    }
}
