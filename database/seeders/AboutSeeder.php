<?php
namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;
use App\Traits\TableAutoIncreamentTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class AboutSeeder extends Seeder {
    use TableAutoIncreamentTrait;
    
    public function run() {
        
        Schema::disableForeignKeyConstraints();

        DB::table('abouts')->truncate();
        DB::table('about_translations')->truncate();
       
           $info = new About;
           $info->title="نبذة عن شركة المزرعة الزراعية";
           $info->description="شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية  ";
           $info->image="104.jpg";
           $info->created_at=date('Y-m-d H:i:s');
           $info->updated_at=date('Y-m-d H:i:s');
           $info->save();

        Schema::enableForeignKeyConstraints();
        
        //create cache file
        Cache::store('file')->put('about_us',About::get());
    }
}
