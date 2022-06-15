<?php
namespace Database\Factories;
use App\Models\{Farmer, Product};
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory {
    protected $model = Product::class;
    public function definition() {
        return [
            'farmer_id'                     =>      Farmer::all()->random()->id,
            'name'                          =>      $this->faker->unique()->name,
            'description'                   =>      $this->faker->paragraph,
            'status'                        =>      Product::PENDING,
            'product_location'              =>      $this->faker->address(),
            'qty'                           =>      $this->faker->numberBetween(100,200),
            'stock'                         =>      Product::IN_STOCK,
        ];
    }
}
