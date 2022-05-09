<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ProtectedHouse extends Model {
    use HasFactory;
    protected $table = "protected_houses";
    protected $guarded=[];
    public $timestamps = true;

    const SPATIAL = 'private', GOVERMENTAL = 'govermental', INTERNATIONAL_ORGANIZATION = 'international organizations',ACTIVE ='active',INACTIVE ='inactive';
    public function getSupportedSide() {
        switch ($this->supported_side) {
            case 'private': $result =   trans('Admin/p_houses.private'); break;
            case 'govermental': $result = trans('Admin/p_houses.govermental') ; break;
            case 'international organizations': $result =  trans('Admin/p_houses.international_organizations') ; break;
        }
        return $result;
    }

    public function getStatus() {
        switch ($this->status) {
            case 'active': $result =   trans('Admin/p_houses.active'); break;
            case 'inactive': $result = trans('Admin/p_houses.inactive') ; break;
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



}
