<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CawProject extends Model {
    use HasFactory;
    protected $table = "caw_projects";
    protected $guarded=[];
    public $timestamps = true;
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

    public function adminDepartment(){
        return $this->belongsTo(AdminDepartment::class,'admin_department_id');
    }


}
