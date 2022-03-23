<?php
namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder {
    public function run() {
        // Setting::factory()->count(1)->create();
        DB::table('settings')->delete();
        Setting::create([
            'site_name' => 'agro',
            'address' => 'iraq',
            'message_maintenance' => 'website in maintance',
            'support_mail' => 'https://www.google.com/',
            'facebook' => 'https://www.facebook.com/',
            'inestegram' => 'https://www.google.com/',
            'twitter' => 'https://www.google.com/',
            'primary_phone' => '01021493036',
            'secondery_phone' => '01021493030',
//            'status' => 'open',
            // 'site_logo' => ,
            // 'site_icon' => ,
        ]);




    }
}
