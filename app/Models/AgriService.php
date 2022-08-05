<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
class AgriService extends Model {
    use HasFactory,Translatable;
    protected $table = "agri_services";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    public function farmer_services(){
        return $this->belongsToMany(FarmerService::class,'farmer_service_agris','agri_service_id','farmer_service_id');
    }

}
