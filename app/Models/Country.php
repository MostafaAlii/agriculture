<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Country extends Model {
    use HasFactory,Translatable;
    protected $table = "countries";
    protected $guarded = [];
    // protected $fillable = ['country_logo','name'];
    protected $with = ['translations'];
    protected $appends = ['country_flag_path'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    // Country Flag Image Appends ::
    public function getCountryFlagPathAttribute() {
        return  asset('Dashboard/img/countryFlags/' . $this->country_logo);
    }
    // Country Has Many Proviences ::
    public function provinces(): HasMany {
        return $this->hasMany(Province::class);
    }
}
