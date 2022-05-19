<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;
class SubscriptionTableSeeder extends Seeder {
    public function run() {
        DB::table('subscriptions')->truncate();
        Subscription::factory(100)->create();
    }
}
