<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
class State extends Model {
    use HasFactory,Translatable;
    protected $table = "states";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    // States Has Many Village ::
    public function villages(): HasMany {
        return $this->hasMany(Village::class);
    }

    // State Has One Area
    public function area(): BelongsTo {
        return $this->belongsTo(Area::class);
    }

    // State Has Many Product ::
    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }
}
