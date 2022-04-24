<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SupportedSide;
class supportedSideSeeder extends Seeder
{

    public function run()
    {
        DB::table('supported_sides')->delete();
        $supports = [

            [
                'en'=> 'governmental',
                'ar'=> ' جهة حكومية'
            ],
            [
                'en'=> 'private',
                'ar'=> 'جهة خاصة'
            ],
            [
                'en'=> 'international organizations',
                'ar'=> 'منظمات دولية'
            ],


        ];
        foreach($supports as $s){
            SupportedSide::create(['Name'=>$s]);
        }
    }
}
