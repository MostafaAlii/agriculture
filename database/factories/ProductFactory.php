<?php
namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\{Farmer, Product};
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory {
    protected $model = Product::class;
    public function definition() {
        return [
            'farmer_id'                     =>      Farmer::all()->random()->id,
            'name'                          =>      $this->faker->unique()->name,
            'description'                   =>      $this->faker->paragraph,
            'status'                        =>      Product::ACTIVE,
            'product_location'              =>      $this->faker->address(),
            'qty'                           =>      $this->faker->randomElement([0,10,20,30,40,50,60,70,80,90,100]),
            // 'stock'                         =>      $this->faker->randomElement([0,1]),
            'stock'                         =>      Product::IN_STOCK,
            'sku'                           =>      'PRO-' . Str::random(8),
            'special_price' => $this->faker->randomElement([0,10,20,30,40,50,60,70,80,90,100]),
        ];
    }
}
