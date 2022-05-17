<?php

namespace Database\Factories;
use App\Models\SummerCropFarmerCrop;
use App\Models\FarmerCrop;
use App\Models\Crop;

use App\Models\SummerCrop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SummerCropFarmerCropFactory extends Factory
{
   protected $molel= SummerCropFarmerCrop::class;
    public function definition()
    {
        return [



            'farmer_crop_id'       => $this->faker->numberBetween(1, FarmerCrop::count()),
            'summer_crop_id'      => $this->faker->numberBetween(1, SummerCrop::count()),

        ];
    }



}
