<?php

namespace Database\Factories;


use App\Models\Wholesale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class wholesaleFactory extends Factory
{
    protected $model = Wholesale::class;
    public function definition()
    {
         //  wholesale
        $wholesale = [
            "داهوك","زاخو","بارداراش","أكري"
        ];

        return [
            'Name'             => $this->faker->randomElement([$wholesale[0],$wholesale[1],$wholesale[2],$wholesale[3]]),
            ];



    }


}
