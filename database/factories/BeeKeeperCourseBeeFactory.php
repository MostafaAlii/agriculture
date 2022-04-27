<?php

namespace Database\Factories;
use App\Models\BeeKeeper;
use App\Models\CourseBee;
use App\Models\BeeKeeperCourseBee;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BeeKeeperCourseBeeFactory extends Factory
{
   protected $molel= BeeKeeperCourseBee::class;
    public function definition()
    {
        return [



            'bee_keeper_id'       => $this->faker->numberBetween(1, BeeKeeper::count()),
            'course_bee_id'      => $this->faker->numberBetween(1, CourseBee::count()),

        ];
    }



}
