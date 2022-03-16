<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
class Area extends Model {
    use HasFactory,Translatable;
    protected $table = "areas";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    // Area Has Many States ::
    public function states(){
        return $this->hasMany(State::class);
    }

    // Provinces Has One Area
    public function province() {
        return $this->belongsTo(Province::class);
    }
}
