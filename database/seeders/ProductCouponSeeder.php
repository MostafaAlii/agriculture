<?php
namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\Farmer;
use App\Models\ProductCoupon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class ProductCouponSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('product_coupons')->truncate();
        ProductCoupon::create([
            'code'              =>              'Mostafa350',
            'type'              =>              'fixed',
            'value'             =>              350,
            'description'       =>              'Discount 350 EGP on your sales on website',
            'use_times'         =>              20,
            'start_date'        =>              Carbon::now(),
            'expire_date'       =>              Carbon::now()->addMonth(),
            'greater_than'      =>              600,
            'status'            =>              1,
            'user_id'           =>              Farmer::all()->random()->id,
        ]);

        ProductCoupon::create([
            'code'              =>              'FiftyFifty',
            'type'              =>              'percentage',
            'value'             =>              30,
            'description'       =>              'Discount 30% on your sales on website',
            'use_times'         =>              5,
            'start_date'        =>              Carbon::now(),
            'expire_date'       =>              Carbon::now()->addWeek(),
            'greater_than'      =>              null,
            'status'            =>              1,
            'user_id'           =>              Farmer::all()->random()->id,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
