<?php
namespace Database\Seeders;

use App\Models\About;
use App\Models\Image;
use App\Models\Setting;
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
           $info->created_at=date('Y-m-d H:i:s');
           $info->updated_at=date('Y-m-d H:i:s');
           $info->save();

           Image::insert([
            'filename'          => '104.jpg', // in public\Dashboard\img\about
            'imageable_id'      => '1',
            'imageable_type'    => 'App\Models\About'
        ]);

        //create cache file
        Cache::store('file')->add('about_us',$info);
       }
       
      


    }
}
