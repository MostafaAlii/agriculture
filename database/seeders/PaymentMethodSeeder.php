<?php
namespace Database\Seeders;
use App\Models\Farmer;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class PaymentMethodSeeder extends Seeder
{
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('payment_methods')->truncate();
        PaymentMethod::create([
            'name'                      => 'PayPal',
            'code'                      => 'PPEX',
            'driver_name'               => 'PayPal_Express',
            'merchant_email'            => null,
            'username'                  => null,
            'password'                  => null,
            'secret'                    => null,
            'sandbox_merchant_email'    => null,
            'sandbox_username'          => null,
            'sandbox_password'          => null,
            'sandbox_secret'            => null,
            'sandbox'                   => true,
            'status'                    => true,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
