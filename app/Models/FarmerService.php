<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FarmerService extends Model {
    use HasFactory;
    public $timestamps = true;
    protected $table = "farmer_services";
    protected $fillable = ['farmer_id','admin_id','area_id','village_id','state_id','phone','email'];



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

    public function agri_services(){
        return $this->belongsToMany(AgriService::class,'farmer_service_agris','farmer_service_id','agri_service_id');
    }

    public function agrit_services(){
        return $this->belongsToMany(AgriTService::class,'farmer_service_agri_t_s','farmer_service_id','agri_t_service_id');
    }

    public function water_services(){
        return $this->belongsToMany(WaterService::class,'farmer_service_waters','farmer_service_id','water_service_id');
    }
}
