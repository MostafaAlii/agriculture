<?php

namespace Database\Factories;
use App\Models\BeeDisaster;
use App\Models\BeeKeeper;
use App\Models\BeeKeeperBeeDisaster;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BeeKeeperBeeDisasterFactory extends Factory
{
   protected $molel= BeeKeeperBeeDisaster::class;
    public function definition()
    {
        return [



            'bee_keeper_id'       => $this->faker->numberBetween(1, BeeKeeper::count()),
            'bee_disaster_id'      => $this->faker->numberBetween(1, BeeDisaster::count()),

        ];
    }



}
