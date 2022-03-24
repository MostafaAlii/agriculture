<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Department extends Model implements TranslatableContract{
    
    use HasFactory,Translatable;
    
    protected $table = "departments";
    protected $guarded = [];

    protected $with=['translations'];
    public $translatedAttributes=['name','description','keyword'];

    public $timestamps = true;

    public function childs() {
        return $this->hasMany('App\Models\Department','parent_id','id') ;
    }

    public function department_country() {
        return $this->belongsTo('App\Models\Country','country_id') ;
    }

    public function department_province() {
        return $this->belongsTo('App\Models\Province','province_id') ;
    }
    
    public function department_area() {
        return $this->belongsTo('App\Models\Area','area_id') ;
    }

    public function department_state() {
        return $this->belongsTo('App\Models\State','state_id') ;
    }

    public function department_village() {
        return $this->belongsTo('App\Models\Village','village_id') ;
    }
        
    // public function childs() {
    //     return $this->belongsTo(self::class,'parent_id') ;
    // }

    // public function scopeParent($query){
    //     return $query->whereNull('parent_id');
    // }
    // public function scopeChild($query){
    //     return $query->whereNotNull('parent_id');
    // }
}
