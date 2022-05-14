<?php

namespace Database\Factories;
use App\Models\Area;
use App\Models\Orchard;
use App\Models\Admin;
use App\Models\Farmer;

use App\Models\State;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrchardFactory extends Factory
{
   protected $molel= Orchard::class;
    public function definition()
    {
        return [

            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('###########'),
            'area_id'    => $this->faker->numberBetween(1, Area::count()),
            'state_id'    => $this->faker->numberBetween(1, State::count()),
            'village_id'    => $this->faker->numberBetween(1, Village::count()),
            'admin_id'       => $this->faker->numberBetween(1, Admin::count()),
            'farmer_id'      => $this->faker->numberBetween(1, Farmer::count()),
            'supported_side'      => $this->faker->randomElement(["private","govermental","international_organizations"]),
            'unit_id'      => $this->faker->randomElement([3, 4]),
            'orchard_area'=>$this->faker->numberBetween([1,2,3,4, 5]),
            'tree_count_per_orchard'=>$this->faker->numberBetween([100,200,300,400, 500,600,700,800,900,1000]),
            'land_category_id'    => $this->faker->randomElement([1,2, 3]),

        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
