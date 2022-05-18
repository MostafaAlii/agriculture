<?php
namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;
use App\Traits\TableAutoIncreamentTrait;
use Illuminate\Support\Facades\Cache;

class AboutSeeder extends Seeder {
    use TableAutoIncreamentTrait;
    
    public function run() {
        
       
       //call trait to handel aut-increament
       $this->refreshTable('abouts');
       $this->refreshTable('about_translations');
       //=======check if found data in table or not ========
       $infos = About::get();
      if (count($infos)==0) {
       
           $info = new About;
           $info->title="نبذة عن شركة المزرعة الزراعية";
           $info->description="شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية شركة المزرعة الزراعية  ";
           $info->image="104.jpg";
           $info->created_at=date('Y-m-d H:i:s');
           $info->updated_at=date('Y-m-d H:i:s');
           $info->save();
           
        //create cache file
        Cache::store('file')->put('about_us',$info);
      }
       
      


    }
}
