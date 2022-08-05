<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model {
    use HasFactory,Translatable;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $table = "villages";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    public function state(): BelongsTo {
        return $this->belongsTo(State::class);
    }


    public function area() {
        return $this->belongsToThrough(Area::class,State::class);
    }
    public function province() {
        return $this->belongsToThrough(Province::class,[Area::class,State::class]);
    }
    public function country() {
        return $this->belongsToThrough(Country::class,[Province::class,Area::class,State::class]);
    }

    public function farmers(){
        return $this->hasMany(Farmer::class);
    }
    public function admins(): HasMany {
        return $this->hasMany(Admin::class);
    }
}
