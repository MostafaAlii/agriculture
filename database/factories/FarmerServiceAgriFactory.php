<?php

namespace Database\Factories;
use App\Models\AgriService;
use App\Models\FarmerService;
use App\Models\FarmerServiceAgri;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FarmerServiceAgriFactory extends Factory
{
   protected $molel= FarmerServiceAgri::class;
    public function definition()
    {
        return [



            'farmer_service_id'       => $this->faker->numberBetween(1, FarmerService::count()),
            'agri_service_id'      => $this->faker->numberBetween(1, AgriService::count()),

        ];
    }



}
