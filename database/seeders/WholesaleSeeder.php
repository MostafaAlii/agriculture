<?php

namespace Database\Seeders;

use App\Models\Wholesale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WholesaleSeeder extends Seeder
{

    public function run()
    {
        Wholesale::factory(4)->create();

    }
}
