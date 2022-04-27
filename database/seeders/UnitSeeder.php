<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->delete();
        $units = [

            [
                'en'=> 'kg',
                'ar'=> 'كيلو غرام'
            ],
            [
                'en'=> 'ton',
                'ar'=> 'طن'
            ],
            [
                'en'=> 'hictar',
                'ar'=> 'هيكتار'
            ],
            [
                'en'=> 'donom',
                'ar'=> 'دونم'
            ],
            [
                'en'=> 'm2',
                'ar'=> 'متر مربع'
            ],
            [
                'en'=> ' mm',
                'ar'=> 'ميلي متر'
            ],


        ];
        foreach($units as $u){
            Unit::create(['Name'=>$u]);
        }
    }
}
