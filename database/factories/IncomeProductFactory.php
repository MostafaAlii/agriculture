<?php

namespace Database\Factories;
use App\Models\Area;
use App\Models\Country;
use App\Models\Currency;
use App\Models\IncomeProduct;
use App\Models\Admin;
use App\Models\Province;
use App\Models\Unit;

use App\Models\AdminDepartment;
use App\Models\SupportedSide;
use App\Models\Village;
use App\Models\WholeProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IncomeProductFactory extends Factory
{
   protected $molel= IncomeProduct::class;
    public function definition()
    {
        return [


            'country_id'       => $this->faker->numberBetween(1, Country::count()),
            'Province_id'      => $this->faker->numberBetween(1, Province::count()),
            'area_id'    => $this->faker->numberBetween(1, Area::count()),
            'admin_id'       => $this->faker->numberBetween(1, Admin::count()),
            'unit_id'      => $this->faker->randomElement([1, 2]),
            'whole_product_id'=>$this->faker->numberBetween(1, WholeProduct::count()),
            'currency_id'=>$this->faker->numberBetween(1, Currency::count()),
            'income_product_amount'=>$this->faker->numberBetween([100,200,300,400, 500]),
            'admin_dep_name'=>$this->faker->randomElement(["داهوك", "زاخو",'عقرة','برداش']),

            'income_product_price'=>$this->faker->numberBetween([100,200,300,400, 500]),
            'income_product_date'=>$this->faker->date(),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
