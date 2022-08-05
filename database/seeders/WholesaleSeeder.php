<?php
namespace Database\Seeders;

use App\Models\Wholesale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class WholesaleSeeder extends Seeder {

    public function run() {
        Wholesale::factory()->create();
    }
}
