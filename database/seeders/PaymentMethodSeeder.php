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
        PaymentMethod::factory()->count(35)->create();
        Schema::enableForeignKeyConstraints();
    }
}
