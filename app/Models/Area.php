<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
class Area extends Model {
    use HasFactory,Translatable;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    protected $table = "areas";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    // Area Has Many States ::
    public function states(): HasMany{
        return $this->hasMany(State::class);
    }
    public function villages(){
        return $this->hasManyThrough(Village::class,State::class);
    }

    // Provinces Has One Area
    public function province(): BelongsTo {
        return $this->belongsTo(Province::class);
    }

    public function country() {

        return $this->belongsToThrough(Country::class, Province::class);
    }
}
