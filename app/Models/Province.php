<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Province extends Model {
    use HasFactory,Translatable;
    protected $table = "provinces";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    // Province Has Many Areas ::
    public function areas(): HasMany {
        return $this->hasMany(Area::class);
    }

    // Province Has One Country
    public function country(): BelongsTo {
        return $this->belongsTo(Country::class);
    }
}
