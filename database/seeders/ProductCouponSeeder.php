<?php
namespace Database\Seeders;
use App\Models\ProductCoupon;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ProductCouponSeeder extends Seeder {
    public function run() {
        ProductCoupon::create([
            'code'              => 'Mostafa350',
            'type'              => 'fixed',
            'value'             => 350,
            'description'       => 'Discount 350 EGP on your sales on website',
            'use_times'         => 20,
            'start_date'        => Carbon::now(),
            'expire_date'       => Carbon::now()->addMonth(),
            'greater_than'      => 600,
            'status'            => 1,
        ]);

        ProductCoupon::create([
            'code'              => 'FiftyFifty',
            'type'              => 'percentage',
            'value'             => 30,
            'description'       => 'Discount 30% on your sales on website',
            'use_times'         => 5,
            'start_date'        => Carbon::now(),
            'expire_date'       => Carbon::now()->addWeek(),
            'greater_than'      => null,
            'status'            => 1,
        ]);
    }
}
