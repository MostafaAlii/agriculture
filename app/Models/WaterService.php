<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class WaterService extends Model {
    use HasFactory,Translatable;
    protected $table = "water_services";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    public function farmer_services(){
        return $this->belongsToMany(FarmerService::class,'farmer_service_waters','water_service_id','farmer_service_id');
    }

}
