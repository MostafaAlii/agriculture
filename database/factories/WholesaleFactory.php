<?php

namespace Database\Factories;


use App\Models\Wholesale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WholesaleFactory extends Factory
{

    protected $model = Wholesale::class;
    public function definition()
    {
        $wholesales = [
            "زاخو",
            "داهوك",
            "أكري",
            "بارداراش"

        ];

        return [
            'Name'             => $this->faker->unique()->randomElement([$wholesales[0],$wholesales[1],$wholesales[2],$wholesales[3]])

        ];




    }


}
