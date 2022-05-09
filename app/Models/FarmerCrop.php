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

    public function crops()
    {
        return $this->belongsToMany( Crop::class,'crop_farmer_crops','farmer_crop_id',
            'crop_id')->withPivot('area');
    }
}
