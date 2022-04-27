<?php

namespace Database\Factories;
use App\Models\CropFarmerCrop;
use App\Models\FarmerCrop;
use App\Models\Crop;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CropFarmerCropFactory extends Factory
{
   protected $molel= CropFarmerCrop::class;
    public function definition()
    {
        return [



            'farmer_crop_id'       => $this->faker->numberBetween(1, FarmerCrop::count()),
            'crop_id'      => $this->faker->numberBetween(1, Crop::count()),
            'area'=>$this->faker->numberBetween([100,200,300,400,500]),

        ];
    }



}
