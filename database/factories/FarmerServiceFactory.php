<?php

namespace Database\Factories;
use App\Models\Area;
use App\Models\FarmerService;
use App\Models\State;
use App\Models\Admin;
use App\Models\Farmer;

use App\Models\AdminDepartment;
use App\Models\SupportedSide;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FarmerServiceFactory extends Factory
{
    protected $molel= FarmerService::class;
    public function definition()
    {
        return [


            'village_id'    => $this->faker->numberBetween(1, Village::count()),
            'area_id'    => $this->faker->numberBetween(1, Area::count()),
            'state_id'    => $this->faker->numberBetween(1, State::count()),
            'admin_id'       => $this->faker->numberBetween(1, Admin::count()),
            'farmer_id'      => $this->faker->numberBetween(1, Farmer::count()),
            'agri_services_count'=> $this->faker->numberBetween([1, 10]),
            'agri_t_services_count'=> $this->faker->numberBetween([1, 10]),

            'water_services_count'=> $this->faker->numberBetween([1, 10]),


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
