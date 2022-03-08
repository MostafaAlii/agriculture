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
        'support_mail','primary_phone','secondery_phone', 'side_slug', 'social_link','site_name', 'address','message_maintenance'];
    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['site_name', 'address','message_maintenance'];


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
