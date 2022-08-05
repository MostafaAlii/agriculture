<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BeeKeeper extends Model {
    use HasFactory;
    protected $table = "bee_keepers";


    protected $fillable=['admin_id','farmer_id','state_id','area_id','village_id','died_beehive_count',
        'annual_new_product_beehive','annual_old_product_beehive','new_beehive_count',
        'old_beehive_count','unit_id','supported_side','cost','phone','phone'];
    public $timestamps = true;
    const SPATIAL = 'private', GOVERMENTAL = 'govermental', INTERNATIONAL_ORGANIZATION = 'international organizations';
    public function getSupportedSide() {
        switch ($this->supported_side) {
            case 'private': $result =   trans('Admin/orchards.private'); break;
            case 'govermental': $result = trans('Admin/orchards.govermental') ; break;
            case 'international organizations': $result =  trans('Admin/orchards.international_organizations') ; break;
        }
        return $result;
    }
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }


    public function farmer(){
        return $this->belongsTo(Farmer::class,'farmer_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }
    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

    public function village(){
        return $this->belongsTo(Village::class,'village_id');
    }
    public function beedisasters(){
        return $this->belongsToMany(BeeDisaster::class,'bee_keeper_bee_disaster','bee_keeper_id','bee_disaster_id');
    }


    public function coursebees(){
        return $this->belongsToMany(CourseBee::class,'bee_keeper_course_bee','bee_keeper_id','course_bee_id');
    }
}
