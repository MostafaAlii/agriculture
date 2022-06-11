<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CawProject extends Model {
    use HasFactory;
    protected $table = "caw_projects";

    protected $fillable=['admin_id','farmer_id','state_id','area_id','village_id','unit_id',
        'project_name','hall_num','animal_count','food_source','marketing_side','cost','type','phone','email'];
    public $timestamps = true;
    const SHIP = 'ship', CAW = 'caw', FISH = 'fish',LOCAL ='local',OUTER ='outer',SPATIAL ='private',GOVERMENTAL='govermental';
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }


    public function farmer(){
        return $this->belongsTo(Farmer::class,'farmer_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function village(){
        return $this->belongsTo(Village::class,'village_id');
    }

    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

    public function getType() {
        switch ($this->type) {
            case 'ship': $result =   trans('Admin/animals.ship'); break;
            case 'caw': $result = trans('Admin/animals.caw') ; break;
            case 'fish': $result =  trans('Admin/animals.fish') ; break;
        }
        return $result;
    }

    public function getSourceFood() {
        switch ($this->food_source) {
            case 'local': $result =   trans('Admin/animals.local'); break;
            case 'outer': $result = trans('Admin/animals.outer') ; break;
        }
        return $result;
    }
    public function getMarketingSide() {
        switch ($this->marketing_side) {
            case 'private': $result =   trans('Admin/animals.private'); break;
            case 'govermental': $result = trans('Admin/animals.govermental') ; break;
        }
        return $result;
    }

}
