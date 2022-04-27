<?php

namespace Database\Factories;
use App\Models\Tree;
use App\Models\Orchard;
use App\Models\OrchardTree;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrchardTreeFactory extends Factory
{
   protected $molel= OrchardTree::class;
    public function definition()
    {
        return [



            'orchard_id'       => $this->faker->numberBetween(1, Orchard::count()),
            'tree_id'      => $this->faker->numberBetween(1, Tree::count()),

        ];
    }



}
