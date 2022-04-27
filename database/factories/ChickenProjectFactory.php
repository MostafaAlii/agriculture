<?php

namespace Database\Factories;
use App\Models\Area;
use App\Models\CawProject;
use App\Models\Orchard;
use App\Models\Admin;
use App\Models\Farmer;
use App\Models\Unit;

use App\Models\AdminDepartment;
use App\Models\State;
use App\Models\SupportedSide;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ChickenProjectFactory extends Factory
{
   protected $molel= ChickenProject::class;
    public function definition()
    {
        return [

            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('###########'),

            'area_id'       => $this->faker->numberBetween(1, Area::count()),
            'state_id'      => $this->faker->numberBetween(1, State::count()),
            'village_id'    => $this->faker->numberBetween(1, Village::count()),
            'admin_department_id'  => 18,
            'admin_id'       => $this->faker->numberBetween(1, Admin::count()),
            'farmer_id'      => $this->faker->numberBetween(1, Farmer::count()),
            'project_name'=>$this->faker->name(),
            'food_source'=>$this->faker->randomElement(['local','imported']),
            'marketing_side'=>$this->faker->randomElement(['private','govermental']),
            'suse_source'=>$this->faker->randomElement(['local','imported']),
            'cost'=>$this->faker->numberBetween([10],[1000]),
            'power'=>$this->faker->randomElement(['فيول','كهرباء','أخرى']),

            'hall_num'=>$this->faker->numberBetween([10],[30]),


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
