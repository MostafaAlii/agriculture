<?php

namespace Database\Factories;
use App\Models\FarmerServiceWater;
use App\Models\WaterService;
use App\Models\FarmerService;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FarmerServiceWaterFactory extends Factory
{
   protected $molel= FarmerServiceWater::class;
    public function definition()
    {
        return [


            'farmer_service_id'       => $this->faker->numberBetween(1, FarmerService::count()),
            'water_service_id'      => $this->faker->numberBetween(1, WaterService::count()),

        ];
    }



}
