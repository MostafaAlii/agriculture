<?php

namespace Database\Factories;

use App\Models\TreeType;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class treeTypeFactory extends Factory
{
    protected $model = TreeType::class;
    public function definition()
    {
            $i=1;
            $type = [
                "حمضيات",
                "حراجية",
                "لوزيات",
                "استوائية",


            ];
            return [
                'tree_type'             => $this->faker->randomElement([$type[0],$type[1],$type[2],$type[3]]),

            ];




    }


}
