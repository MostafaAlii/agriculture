<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FarmerCrop extends Model {
    use HasFactory;
    protected $table = "farmer_crops";
    public $timestamps = true;
    protected $guarded=[];



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

    public function landCategory(){
        return $this->belongsTo(LandCategory::class,'land_category_id');
    }

    public function summer_crops()
    {
        return $this->belongsToMany( SummerCrop::class,'summer_crop_farmer_crop','farmer_crop_id',
            'summer_crop_id');
    }
    public function winter_crops()
    {
        return $this->belongsToMany( WinterCrop::class,'winter_crop_farmer_crop','farmer_crop_id',
            'winter_crop_id');
    }
}
