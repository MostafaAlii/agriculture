<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Country extends Model implements TranslatableContract{
    use HasFactory,Translatable;
    protected $table = "countries";
    protected $guarded = [];

    public $translatedAttributes = ['name'];
    public $timestamps = true;


    public function provinces(){
        return $this->hasMany(Province::class);
    }
//    public function image()
//    {
//        return $this->morphOne(Image::class, 'imageable');
//    }
}
