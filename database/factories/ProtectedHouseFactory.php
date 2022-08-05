<?php

namespace Database\Factories;
use App\Models\ProtectedHouse;
use App\Models\Admin;
use App\Models\Farmer;
use App\Models\Unit;

use App\Models\State;
use App\Models\Area;

use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProtectedHouseFactory extends Factory
{
   protected $molel= ProtectedHouse::class;
    public function definition()
    {
        return [


            'village_id'    => $this->faker->numberBetween(1, Village::count()),
            'area_id'    => $this->faker->numberBetween(1, Area::count()),
            'state_id'    => $this->faker->numberBetween(1, State::count()),
            'admin_id'       => $this->faker->numberBetween(1, Admin::count()),
            'farmer_id'      => $this->faker->numberBetween(1, Farmer::count()),
            'supported_side'      => $this->faker->randomElement(["private","govermental","international organizations"]),
            'unit_id'      => $this->faker->randomElement([1,2]),
            'average_product_annual'=>$this->faker->numberBetween([100,200,300,400, 500]),
            'count_protected_house'=>$this->faker->numberBetween([10,20,30,50, 100]),

            'status'=>$this->faker->randomElement(['active','inactive']),

        ];
    }


}
