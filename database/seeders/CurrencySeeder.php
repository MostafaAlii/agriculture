<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{

    public function run()
    {
        Currency::factory(3)->create();

    }
}
