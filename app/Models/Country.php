<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Country extends Model {
    use HasFactory,Translatable;
    protected $table = "countries";
    protected $guarded = [];
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
    public function country_trans() {
        return $this->hasOne(CountryTranslation::class);
    }
}
