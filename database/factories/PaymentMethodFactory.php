<?php
namespace Database\Factories;
use App\Models\PaymentMethod;
use App\Models\Farmer;
use Illuminate\Database\Eloquent\Factories\Factory;
class PaymentMethodFactory extends Factory {
    protected $model = PaymentMethod::class;
    public function definition() {
        return [
            'farmer_id'                 =>  Farmer::factory(),
            'name'                      => $this->faker->creditCardType,
            'code'                      => $this->faker->unique()->colorName,
            'driver_name'               => $this->faker->unique()->name,
            'merchant_email'            => null,
            'username'                  => null,
            'password'                  => null,
            'secret'                    => null,
            'sandbox_merchant_email'    => null,
            'sandbox_username'          => null,
            'sandbox_password'          => null,
            'sandbox_secret'            => null,
            'sandbox'                   => true,
            'status'                    => $this->faker->boolean(),
        ];
    }
}
