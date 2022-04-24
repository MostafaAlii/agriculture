<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BeeKeeper extends Model {
    use HasFactory;
    protected $table = "bee_keepers";
    protected $guarded=[];
    public $timestamps = true;


    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }
    public function supported_side(){
        return $this->belongsTo(SupportedSide::class,'supported_side_id');
    }

    public function farmer(){
        return $this->belongsTo(Farmer::class,'farmer_id');
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

    public function adminDepartment(){
        return $this->belongsTo(AdminDepartment::class,'admin_department_id');
    }
    public function coursebees(){
        return $this->belongsToMany(CourseBee::class,'bee_keeper_course_bee','bee_keeper_id','course_bee_id');
    }
}
