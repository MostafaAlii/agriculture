<?php
namespace Database\Factories;
use App\Models\Farmer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory {
    protected $model = Product::class;
    public function definition() {
        return [
            'farmer_id'                     =>      Farmer::all()->random()->id,
            
            'price'                         =>      $this->faker->numberBetween($min = 1500, $max = 6000),
            'manage_stock'                  =>      $this->faker->boolean(),
            'in_stock'                      =>      $this->faker->boolean(),
            'viewed'                        =>      $this->faker->randomDigitNotNull(),
            'name'                          =>      $this->faker->name,
            'slug'                          =>      $this->faker->unique()->name,
            'description'                   =>      $this->faker->paragraph,
            'status'                        =>      $this->faker->boolean(),
            'product_location'              =>      $this->faker->boolean(),
        ];
    }
}
