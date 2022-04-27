<?php

namespace Database\Factories;
use App\Models\Area;
use App\Models\FarmerCrop;
use App\Models\Admin;
use App\Models\Farmer;

use App\Models\AdminDepartment;
use App\Models\State;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FarmerCropFactory extends Factory
{
   protected $molel= FarmerCrop::class;
    public function definition()
    {
        return [

            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('###########'),

            'area_id'       => $this->faker->numberBetween(1, Area::count()),
            'state_id'      => $this->faker->numberBetween(1, State::count()),
            'village_id'    => $this->faker->numberBetween(1, Village::count()),
            'admin_department_id'  => 17,
            'admin_id'       => $this->faker->numberBetween(1, Admin::count()),
            'farmer_id'      => $this->faker->numberBetween(1, Farmer::count()),
            'land_category_id'    => $this->faker->randomElement([1,2, 3]),

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
