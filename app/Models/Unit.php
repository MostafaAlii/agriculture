<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Unit extends Model {
    use HasFactory,Translatable;
    const GENERAL = 0, FOR_PRODUCT = 1;

    protected $table = "units";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['Name'];
    public $timestamps = true;

    public function beekeepers(){
        return $this->hasMany(BeeKeeper::class);
    }

    public function scopeProductVisability($query){
        return $query->whereVisibility(Unit::FOR_PRODUCT) ;
    }
}
