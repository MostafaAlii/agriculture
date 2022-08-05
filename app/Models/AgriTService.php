<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class AgriTService extends Model {
    use HasFactory,Translatable;
    protected $table = "agri_t_services";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    public function farmer_services(){
        return $this->belongsToMany(FarmerService::class,'farmer_service_agri_t_s','agri_t_service_id','farmer_service_id');
    }

}
