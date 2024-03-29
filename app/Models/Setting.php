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
        'ar_site_logo','site_icon','en_site_logo','ku_site_logo'
    ];
    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['site_name', 'address','message_maintenance'];

    protected $appends = ['setting_icon_path','setting_ar_logo_path','setting_en_logo_path','setting_ku_logo_path'];
    public $timestamps = true;

    // Country Flag Image Appends ::
    public function getSettingIconPathAttribute() {
        return  asset('Dashboard/img/settingIcon/' . $this->site_icon);

    }

    public function getSettingArLogoPathAttribute() {
        return  asset('Dashboard/img/settingArLogo/' . $this->ar_site_logo);
    }
    public function getSettingEnLogoPathAttribute() {
        return  asset('Dashboard/img/settingEnLogo/' . $this->en_site_logo);
    }

    public function getSettingKuLogoPathAttribute() {
        return  asset('Dashboard/img/settingKuLogo/' . $this->ku_site_logo);
    }
//    public function getArSiteLogoAttribute()
//    {
//        if (! $this->attributes['ar_site_logo']) {
//        return asset('Dashboard/img/Default/logo_2_ar.png');
//    }
//
//        return $this->attributes['ar_site_logo'];
//    }
//
//    public function getEnSiteLogoAttribute()
//    {
//        if (! $this->attributes['en_site_logo']) {
//            return (url::asset('Dashboard/img/Default/Logo_2_en.png'));
//        }
//
//        return $this->attributes['en_site_logo'];
//    }
//    public function getKuSiteLogoAttribute()
//    {
//        if (! $this->attributes['ku_site_logo']) {
//            return asset('Dashboard/img/Default/Logo_2_ku.png');
//        }
//
//        return $this->attributes['ku_site_logo'];
//    }
}
