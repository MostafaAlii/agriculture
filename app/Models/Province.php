<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 1. To specify package’s class you are using
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Province extends Model implements TranslatableContract
{
    use Translatable,HasFactory; // 2. To add translation methods

    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name'];
    protected $guarded = [];

    public  function country(){
        return $this->belongsTo(Country::class ,'country_id');
    }


}


