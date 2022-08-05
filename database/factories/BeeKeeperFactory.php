<?php

namespace Database\Factories;
use App\Models\Area;
use App\Models\BeeKeeper;
use App\Models\Admin;
use App\Models\Farmer;
use App\Models\Unit;
use App\Models\State;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BeeKeeperFactory extends Factory
{
   protected $molel= BeeKeeper::class;
    public function definition()
    {
        return [


            'area_id'    => $this->faker->numberBetween(1, Area::count()),
            'state_id'    => $this->faker->numberBetween(1, State::count()),
            'village_id'    => $this->faker->numberBetween(1, Village::count()),
            'admin_id'       => $this->faker->numberBetween(1, Admin::count()),
            'farmer_id'      => $this->faker->numberBetween(1, Farmer::count()),
            'supported_side'      => $this->faker->randomElement(["private","govermental","international organizations"]),
            'unit_id'      => $this->faker->randomElement([1, 2]),
            'old_beehive_count'=>$this->faker->numberBetween([10],[50]),
            'cost'=>$this->faker->numberBetween([10],[50]),
            'new_beehive_count'=>$this->faker->numberBetween([10],[20]),
            'died_beehive_count'=>$this->faker->numberBetween([1],[10]),
           'annual_old_product_beehive'=>$this->faker->numberBetween([1],[100]),
            'annual_new_product_beehive'=>$this->faker->numberBetween([100],[500]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
