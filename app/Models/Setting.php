<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    protected $table = "settings";
    protected $fillable = [
        'support_mail','primary_phone','secondery_phone', 'facebook', 'twitter','inestegram',
        'site_name', 'address','message_maintenance','status',
        'site_logo','site_icon'
    ];
    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['site_name', 'address','message_maintenance'];

    protected $appends = ['setting_icon_path','setting_logo_path'];
    public $timestamps = true;

    // Country Flag Image Appends ::
    public function getSettingIconPathAttribute() {
        return  asset('Dashboard/img/settingIcon/' . $this->site_icon);

    }

    public function getSettingLogoPathAttribute() {
        return  asset('Dashboard/img/settingLogo/' . $this->site_logo);
    }
}
