<?php
namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SettingSeeder extends Seeder {
    public function run() {
        DB::table('settings')->delete();
        Setting::create([
            'site_name' => 'agro',
            'address' => 'iraq',
            'message_maintenance' => 'website in maintance',
            'support_mail' => 'app@test.com',
            'facebook' => 'https://www.facebook.com/',
            'inestegram' => 'https://www.instegram.com/',
            'twitter' => 'https://www.twitter.com/',
            'primary_phone' => '01021493036',
            'secondery_phone' => '01021493030',
//            'status' => 'open',
             'ar_site_logo' => '',
            'en_site_logo' => '',

            'site_icon' => '',
        ]);




    }
}
