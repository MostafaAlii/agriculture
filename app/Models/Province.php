<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Astrotomic\Translatable\Translatable;
class Province extends Model {
    use HasFactory,Translatable;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    protected $table = "provinces";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    // Province Has Many Areas ::
    public function areas(): HasMany {
        return $this->hasMany(Area::class);
    }
    public function states() {
        return $this->hasManyThrough(states::class,Area::class);
    }

    public function villages() {
        return $this->hasManyDeep(Village::class,[Area::class,State::class]);
    }

    // Province Has One Country
    public function country(): BelongsTo {
        return $this->belongsTo(Country::class);
    }
}
