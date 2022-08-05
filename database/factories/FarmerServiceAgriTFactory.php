<?php

namespace Database\Factories;
use App\Models\AgriTService;
use App\Models\FarmerService;
use App\Models\FarmerServiceAgriT;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FarmerServiceAgriTFactory extends Factory
{
    protected $molel= FarmerServiceAgriT::class;
    public function definition()
    {
        return [



            'farmer_service_id'       => $this->faker->numberBetween(1, FarmerService::count()),
            'agri_t_service_id'      => $this->faker->numberBetween(1, AgriTService::count()),

        ];
    }



}
