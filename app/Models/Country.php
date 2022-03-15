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
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    public function provinces(): HasMany {
        return $this->hasMany(Province::class);
    }
}
