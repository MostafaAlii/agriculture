<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;
class OptionFactory extends Factory {
    protected $model = Option::class;
    public function definition() {
        return [
            'attribute_id'                      =>      Attribute::all()->random()->id,
            'product_id'                        =>      Product::all()->random()->id,
            'name'                              =>      $this->faker->name,
            'price'                             =>      $this->faker->numberBetween($min = 1500, $max = 6000),
        ];
    }
}
