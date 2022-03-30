<?php
namespace Database\Factories;
use App\Models\Area;
use App\Models\Farmer;
use App\Models\Country;
use App\Models\Product;
use App\Models\Province;
use App\Models\State;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory {
    protected $model = Product::class;
    public function definition() {
        return [
            'farmer_id'                     =>      Farmer::all()->random()->id,
            'country_id'                    =>      Country::all()->random()->id,
            'province_id'                   =>      Province::all()->random()->id,
            'area_id'                       =>      Area::all()->random()->id,
            'state_id'                      =>      State::all()->random()->id,
            'village_id'                    =>      Village::all()->random()->id,
            
            'price'                         =>      $this->faker->numberBetween($min = 1500, $max = 6000),
            'manage_stock'                  =>      $this->faker->boolean(),
            'in_stock'                      =>      $this->faker->boolean(),
            'viewed'                        =>      $this->faker->randomDigitNotNull(),
            'name'                          =>      $this->faker->name,
            'slug'                          =>      $this->faker->unique()->name,
            'description'                   =>      $this->faker->paragraph,
            'status'                        =>      $this->faker->boolean(),
            
            //'address'                       =>      '',
        ];
    }
}
