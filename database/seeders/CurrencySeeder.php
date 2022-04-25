<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{

    public function run()
    {
        DB::table('currencies')->delete();
        $currencies = [

            [
                'en'=> 'Dollar',
                'ar'=> 'دولار'
            ],
            [
                'en'=> 'Iraq Dinar',
                'ar'=> 'دينار عراقي'
            ],
            [
                'en'=> 'Eur',
                'ar'=> 'يورو'
            ],


        ];
        foreach($currencies as $c){
            Currency::create(['Name'=>$c]);
        }
    }
}
