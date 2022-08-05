<?php

namespace Database\Factories;
use App\Models\WinterCropFarmerCrop;
use App\Models\FarmerCrop;
use App\Models\WinterCrop;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WinterCropFarmerCropFactory extends Factory
{
   protected $molel= WinterCropFarmerCrop::class;
    public function definition()
    {
        return [



            'farmer_crop_id'       => $this->faker->numberBetween(1, FarmerCrop::count()),
            'winter_crop_id'      => $this->faker->numberBetween(1, WinterCrop::count()),

        ];
    }



}
